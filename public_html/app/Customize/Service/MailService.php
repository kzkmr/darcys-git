<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize\Service;

use Eccube\Service\MailService as BaseMailService;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\BaseInfo;
use Eccube\Entity\Customer;
use Eccube\Entity\Member;
use Eccube\Entity\MailHistory;
use Eccube\Entity\MailTemplate;
use Eccube\Entity\Order;
use Eccube\Entity\OrderItem;
use Eccube\Entity\Shipping;
use Customize\Entity\ChainStore;
use Customize\Entity\Master\ContractType;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Repository\BaseInfoRepository;
use Eccube\Repository\MailHistoryRepository;
use Eccube\Repository\MailTemplateRepository;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MailService extends BaseMailService
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var MailTemplateRepository
     */
    protected $mailTemplateRepository;

    /**
     * @var MailHistoryRepository
     */
    protected $mailHistoryRepository;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var BaseInfo
     */
    protected $BaseInfo;

    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * MailService constructor.
     *
     * @param \Swift_Mailer $mailer
     * @param MailTemplateRepository $mailTemplateRepository
     * @param MailHistoryRepository $mailHistoryRepository
     * @param BaseInfoRepository $baseInfoRepository
     * @param EventDispatcherInterface $eventDispatcher
     * @param \Twig_Environment $twig
     * @param EccubeConfig $eccubeConfig
     */
    public function __construct(
        \Swift_Mailer $mailer,
        MailTemplateRepository $mailTemplateRepository,
        MailHistoryRepository $mailHistoryRepository,
        BaseInfoRepository $baseInfoRepository,
        EventDispatcherInterface $eventDispatcher,
        \Twig_Environment $twig,
        EccubeConfig $eccubeConfig
    ) {
        $this->mailer = $mailer;
        $this->mailTemplateRepository = $mailTemplateRepository;
        $this->mailHistoryRepository = $mailHistoryRepository;
        $this->BaseInfo = $baseInfoRepository->get();
        $this->eventDispatcher = $eventDispatcher;
        $this->eccubeConfig = $eccubeConfig;
        $this->twig = $twig;
    }

    /**
     * Send customer confirm mail.
     *
     * @param $Customer ????????????
     * @param string $activateUrl ????????????????????????url
     */
    public function sendCustomerConfirmMail(Customer $Customer, $activateUrl)
    {
        log_info('????????????????????????????????????');

        $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_entry_confirm_mail_template_id']);

        $body = $this->twig->render($MailTemplate->getFileName(), [
            'Customer' => $Customer,
            'BaseInfo' => $this->BaseInfo,
            'activateUrl' => $activateUrl,
        ]);

        $message = (new \Swift_Message())
            ->setSubject('???'.$this->BaseInfo->getShopName().'???'.$MailTemplate->getMailSubject())
            ->setFrom([$this->BaseInfo->getEmail01() => $this->BaseInfo->getShopName()])
            ->setTo([$Customer->getEmail()])
            ->setBcc($this->BaseInfo->getEmail01())
            ->setReplyTo($this->BaseInfo->getEmail03())
            ->setReturnPath($this->BaseInfo->getEmail04());

        // HTML???????????????????????????????????????
        $htmlFileName = $this->getHtmlTemplate($MailTemplate->getFileName());
        if (!is_null($htmlFileName)) {
            $htmlBody = $this->twig->render($htmlFileName, [
                'Customer' => $Customer,
                'BaseInfo' => $this->BaseInfo,
                'activateUrl' => $activateUrl,
            ]);

            $message
                ->setContentType('text/plain; charset=UTF-8')
                ->setBody($body, 'text/plain')
                ->addPart($htmlBody, 'text/html');
        } else {
            $message->setBody($body);
        }

        $event = new EventArgs(
            [
                'message' => $message,
                'Customer' => $Customer,
                'BaseInfo' => $this->BaseInfo,
                'activateUrl' => $activateUrl,
            ],
            null
        );
        $this->eventDispatcher->dispatch(EccubeEvents::MAIL_CUSTOMER_CONFIRM, $event);

        $count = $this->mailer->send($message, $failures);

        log_info('????????????????????????????????????', ['count' => $count]);

        return $count;
    }

    /**
     * Send customer complete mail.
     *
     * @param $Customer ????????????
     */
    public function sendCustomerCompleteMail(Customer $Customer)
    {
        log_info('???????????????????????????????????????');

        $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_entry_complete_mail_template_id']);

        $body = $this->twig->render($MailTemplate->getFileName(), [
            'Customer' => $Customer,
            'BaseInfo' => $this->BaseInfo,
        ]);

        $message = (new \Swift_Message())
            ->setSubject('???'.$this->BaseInfo->getShopName().'???'.$MailTemplate->getMailSubject())
            ->setFrom([$this->BaseInfo->getEmail01() => $this->BaseInfo->getShopName()])
            ->setTo([$Customer->getEmail()])
            ->setBcc($this->BaseInfo->getEmail01())
            ->setReplyTo($this->BaseInfo->getEmail03())
            ->setReturnPath($this->BaseInfo->getEmail04());

        // HTML???????????????????????????????????????
        $htmlFileName = $this->getHtmlTemplate($MailTemplate->getFileName());
        if (!is_null($htmlFileName)) {
            $htmlBody = $this->twig->render($htmlFileName, [
                'Customer' => $Customer,
                'BaseInfo' => $this->BaseInfo,
            ]);

            $message
                ->setContentType('text/plain; charset=UTF-8')
                ->setBody($body, 'text/plain')
                ->addPart($htmlBody, 'text/html');
        } else {
            $message->setBody($body);
        }

        $event = new EventArgs(
            [
                'message' => $message,
                'Customer' => $Customer,
                'BaseInfo' => $this->BaseInfo,
            ],
            null
        );
        $this->eventDispatcher->dispatch(EccubeEvents::MAIL_CUSTOMER_COMPLETE, $event);

        $count = $this->mailer->send($message);

        log_info('???????????????????????????????????????', ['count' => $count]);

        return $count;
    }

    /**
     * Send order mail.
     *
     * @param \Eccube\Entity\Order $Order ????????????
     *
     * @return \Swift_Message
     */
    public function sendOrderMail(Order $Order)
    {
        log_info('???????????????????????????');

        $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_order_mail_template_id']);

        $body = $this->twig->render($MailTemplate->getFileName(), [
            'Order' => $Order,
        ]);

        $message = (new \Swift_Message())
            ->setSubject('???'.$this->BaseInfo->getShopName().'???'.$MailTemplate->getMailSubject())
            ->setFrom([$this->BaseInfo->getEmail01() => $this->BaseInfo->getShopName()])
            ->setTo([$Order->getEmail()])
            ->setBcc($this->BaseInfo->getEmail01())
            ->setReplyTo($this->BaseInfo->getEmail03())
            ->setReturnPath($this->BaseInfo->getEmail04());

        // HTML???????????????????????????????????????
        $htmlFileName = $this->getHtmlTemplate($MailTemplate->getFileName());
        if (!is_null($htmlFileName)) {
            $htmlBody = $this->twig->render($htmlFileName, [
                'Order' => $Order,
            ]);

            $message
                ->setContentType('text/plain; charset=UTF-8')
                ->setBody($body, 'text/plain')
                ->addPart($htmlBody, 'text/html');
        } else {
            $message->setBody($body);
        }

        $event = new EventArgs(
            [
                'message' => $message,
                'Order' => $Order,
                'MailTemplate' => $MailTemplate,
                'BaseInfo' => $this->BaseInfo,
            ],
            null
        );
        $this->eventDispatcher->dispatch(EccubeEvents::MAIL_ORDER, $event);

        $count = $this->mailer->send($message);

        $MailHistory = new MailHistory();
        $MailHistory->setMailSubject($message->getSubject())
            ->setMailBody($message->getBody())
            ->setOrder($Order)
            ->setSendDate(new \DateTime());

        // HTML?????????????????????
        $multipart = $message->getChildren();
        if (count($multipart) > 0) {
            $MailHistory->setMailHtmlBody($multipart[0]->getBody());
        }

        $this->mailHistoryRepository->save($MailHistory);

        log_info('???????????????????????????', ['count' => $count]);

        return $message;
    }

    /**
     * Send chainstore confirm mail.
     *
     * @param $Customer ?????????????????????
     * @param string $activateUrl ????????????????????????url
     */
    public function sendChainStoreConfirmMail(Customer $Customer, $activateUrl, ContractType $ContractType = null)
    {
        log_info('?????????????????????????????????????????????');

        $MailTemplate = null;

        if($ContractType->getId() == "2"){
            //??????????????????????????????????????????????????????????????????
            $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_oen_entry_confirm_mail_template_id']);
        }else if($ContractType->getId() == "3"){
            //??????????????????????????????????????????
            $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_kouri_entry_confirm_mail_template_id']);
        }else{
            //???????????????????????????????????????
            $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_entry_confirm_mail_template_id']);
        }

        $body = $this->twig->render($MailTemplate->getFileName(), [
            'Customer' => $Customer,
            'ContractType' => $ContractType,
            'BaseInfo' => $this->BaseInfo,
            'activateUrl' => $activateUrl,
        ]);

        $message = (new \Swift_Message())
            //->setSubject('['.$this->BaseInfo->getShopName().'] '.$MailTemplate->getMailSubject())
            ->setSubject('????????????????????????????????????'.$MailTemplate->getMailSubject())
            ->setFrom([$this->BaseInfo->getEmail01() => $this->BaseInfo->getShopName()])
            ->setTo([$Customer->getEmail()])
            ->setBcc($this->BaseInfo->getEmail01())
            ->setReplyTo($this->BaseInfo->getEmail03())
            ->setReturnPath($this->BaseInfo->getEmail04());

        // HTML???????????????????????????????????????
        $htmlFileName = $this->getHtmlTemplate($MailTemplate->getFileName());
        if (!is_null($htmlFileName)) {
            $htmlBody = $this->twig->render($htmlFileName, [
                'Customer' => $Customer,
                'ContractType' => $ContractType,
                'BaseInfo' => $this->BaseInfo,
                'activateUrl' => $activateUrl,
            ]);

            $message
                ->setContentType('text/plain; charset=UTF-8')
                ->setBody($body, 'text/plain')
                ->addPart($htmlBody, 'text/html');
        } else {
            $message->setBody($body);
        }

        $event = new EventArgs(
            [
                'message' => $message,
                'ContractType' => $ContractType,
                'Customer' => $Customer,
                'BaseInfo' => $this->BaseInfo,
                'activateUrl' => $activateUrl,
            ],
            null
        );
        $this->eventDispatcher->dispatch(EccubeEvents::MAIL_CUSTOMER_CONFIRM, $event);

        $count = $this->mailer->send($message, $failures);

        log_info('?????????????????????????????????????????????', ['count' => $count]);

        return $count;
    }


    /**
     * Send ChainStore complete mail.
     *
     * @param $Customer ?????????????????????
     */
    public function sendChainStoreCompleteMail(Customer $Customer,  $ChainStore, ContractType $ContractType)
    {
        log_info('????????????????????????????????????????????????');

        $MailTemplate = null;

        if($ContractType->getId() == "2"){
            //??????????????????????????????????????????????????????????????????
            $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_oen_entry_complete_mail_template_id']);
        }else if($ContractType->getId() == "3"){
            //??????????????????????????????????????????
            $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_kouri_entry_complete_mail_template_id']);
        }else{
            //???????????????????????????????????????
            $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_entry_complete_mail_template_id']);
        }

        $body = $this->twig->render($MailTemplate->getFileName(), [
            'Customer' => $Customer,
            'BaseInfo' => $this->BaseInfo,
        ]);

        $message = (new \Swift_Message())
            //->setSubject('['.$this->BaseInfo->getShopName().'] '.$MailTemplate->getMailSubject())
            ->setSubject('????????????????????????????????????'.$MailTemplate->getMailSubject())
            ->setFrom([$this->BaseInfo->getEmail01() => $this->BaseInfo->getShopName()])
            ->setTo([$Customer->getEmail()])
            ->setBcc($this->BaseInfo->getEmail01())
            ->setReplyTo($this->BaseInfo->getEmail03())
            ->setReturnPath($this->BaseInfo->getEmail04());

        // HTML???????????????????????????????????????
        $htmlFileName = $this->getHtmlTemplate($MailTemplate->getFileName());
        if (!is_null($htmlFileName)) {
            $htmlBody = $this->twig->render($htmlFileName, [
                'Customer' => $Customer,
                'BaseInfo' => $this->BaseInfo,
            ]);

            $message
                ->setContentType('text/plain; charset=UTF-8')
                ->setBody($body, 'text/plain')
                ->addPart($htmlBody, 'text/html');
        } else {
            $message->setBody($body);
        }

        $event = new EventArgs(
            [
                'message' => $message,
                'Customer' => $Customer,
                'BaseInfo' => $this->BaseInfo,
            ],
            null
        );
        $this->eventDispatcher->dispatch(EccubeEvents::MAIL_CUSTOMER_COMPLETE, $event);

        $count = $this->mailer->send($message);

        log_info('????????????????????????????????????????????????', ['count' => $count]);

        return $count;
    }



    /**
     * Send chainstore mail to admin.
     *
     * @param $Customer ????????????
     */
    public function sendChainStoreConfirmAdminMail(Member $Member, Customer $Customer, ChainStore $ChainStore = null, ContractType $ContractType = null)
    {
        log_info('??????????????????????????????????????????');

        $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_confirm_admin_mail_template_id']);

        $body = $this->twig->render($MailTemplate->getFileName(), [
            'Member' => $Member,
            'Customer' => $Customer,
            'ChainStore' => $ChainStore,
            'ContractType' => $ContractType,
            'BaseInfo' => $this->BaseInfo,
        ]);

        $MailSubject = $MailTemplate->getMailSubject();
        $CustomerName = $Customer->getName01()." ".$Customer->getName02();

        $MailSubject = str_replace("[@NAME]", $CustomerName, $MailSubject);

        $message = (new \Swift_Message())
            ->setSubject('['.$this->BaseInfo->getShopName().'] '.$MailSubject)
            ->setFrom([$this->BaseInfo->getEmail01() => $this->BaseInfo->getShopName()])
            ->setTo([$Member->getEmail()]);
            //->setBcc($this->BaseInfo->getEmail01())
            //->setReplyTo($this->BaseInfo->getEmail03())
            //->setReturnPath($this->BaseInfo->getEmail04());

        // HTML???????????????????????????????????????
        $htmlFileName = $this->getHtmlTemplate($MailTemplate->getFileName());
        if (!is_null($htmlFileName)) {
            $htmlBody = $this->twig->render($htmlFileName, [
                'Member' => $Member,
                'Customer' => $Customer,
                'ChainStore' => $ChainStore,
                'ContractType' => $ContractType,
                'BaseInfo' => $this->BaseInfo,
            ]);

            $message
                ->setContentType('text/plain; charset=UTF-8')
                ->setBody($body, 'text/plain')
                ->addPart($htmlBody, 'text/html');
        } else {
            $message->setBody($body);
        }

        $count = $this->mailer->send($message, $failures);

        log_info('??????????????????????????????????????????', ['count' => $count]);

        return $count;
    }


    /**
     * Send check chainstore mail to admin.
     *
     * @param $Customer ????????????
     */
    public function sendCheckChainStoreMail(Member $Member, $DealerCodeList, $CouponCodeList)
    {
        log_info('??????????????????????????????????????????????????????');

        $YYYY = date("Y");
        $MM = date("m");
        $DD = date("d");

        $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_check_chainstore_admin_mail_template_id']);

        $body = $this->twig->render($MailTemplate->getFileName(), [
            'Member' => $Member,
            'DealerCodeList' => $DealerCodeList,
            'CouponCodeList' => $CouponCodeList,
            'YYYY' => $YYYY,
            'MM' => $MM,
            'DD' => $DD,
            'BaseInfo' => $this->BaseInfo,
        ]);

        $MailSubject = $MailTemplate->getMailSubject();
        $MailSubject = str_replace("[@YYYY]", $YYYY, $MailSubject);
        $MailSubject = str_replace("[@MM]", $MM, $MailSubject);
        $MailSubject = str_replace("[@DD]", $DD, $MailSubject);

        $message = (new \Swift_Message())
            ->setSubject('['.$this->BaseInfo->getShopName().'] '.$MailSubject)
            ->setFrom([$this->BaseInfo->getEmail01() => $this->BaseInfo->getShopName()])
            ->setTo([$Member->getEmail()]);

        // HTML???????????????????????????????????????
        $htmlFileName = $this->getHtmlTemplate($MailTemplate->getFileName());
        if (!is_null($htmlFileName)) {
            $htmlBody = $this->twig->render($htmlFileName, [
                'Member' => $Member,
                'DealerCodeList' => $DealerCodeList,
                'CouponCodeList' => $CouponCodeList,
                'YYYY' => $YYYY,
                'MM' => $MM,
                'DD' => $DD,
                'BaseInfo' => $this->BaseInfo,
            ]);

            $message
                ->setContentType('text/plain; charset=UTF-8')
                ->setBody($body, 'text/plain')
                ->addPart($htmlBody, 'text/html');
        } else {
            $message->setBody($body);
        }

        $count = $this->mailer->send($message, $failures);

        log_info('??????????????????????????????????????????????????????', ['count' => $count]);

        return $count;
    }


    /**
     * Send ????????? order mail.
     *
     * @param \Eccube\Entity\Order $Order ?????????????????????
     *
     * @return \Swift_Message
     */
    public function sendChainStoreOrderMail(Order $Order, ChainStore $ChainStore, ContractType $ContractType)
    {
        log_info('????????????????????????????????????');

        $MailTemplate = null;

        if($ContractType->getId() == "2"){
            //?????????????????????????????????????????????????????????
            $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_oen_order_mail_template_id']);
        }else if($ContractType->getId() == "3"){
            //???????????????????????????????????????????????????
            $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_kouri_order_mail_template_id']);
        }else{
            //???????????????????????????????????????????????????
            $MailTemplate = $this->mailTemplateRepository->find($this->eccubeConfig['eccube_chainstore_order_mail_template_id']);
        }

        $body = $this->twig->render($MailTemplate->getFileName(), [
            'Order' => $Order,
            'ChainStore' => $ChainStore,
            'ContractType' => $ContractType,
        ]);

        $message = (new \Swift_Message())
            //->setSubject('['.$this->BaseInfo->getShopName().'] '.$MailTemplate->getMailSubject())
            ->setSubject('????????????????????????????????????'.$MailTemplate->getMailSubject())
            ->setFrom([$this->BaseInfo->getEmail01() => $this->BaseInfo->getShopName()])
            ->setTo([$Order->getEmail()])
            ->setBcc($this->BaseInfo->getEmail01())
            ->setReplyTo($this->BaseInfo->getEmail03())
            ->setReturnPath($this->BaseInfo->getEmail04());

        // HTML???????????????????????????????????????
        $htmlFileName = $this->getHtmlTemplate($MailTemplate->getFileName());
        if (!is_null($htmlFileName)) {
            $htmlBody = $this->twig->render($htmlFileName, [
                'Order' => $Order,
                'ChainStore' => $ChainStore,
                'ContractType' => $ContractType,
            ]);

            $message
                ->setContentType('text/plain; charset=UTF-8')
                ->setBody($body, 'text/plain')
                ->addPart($htmlBody, 'text/html');
        } else {
            $message->setBody($body);
        }

        $event = new EventArgs(
            [
                'message' => $message,
                'Order' => $Order,
                'ChainStore' => $ChainStore,
                'ContractType' => $ContractType,
                'MailTemplate' => $MailTemplate,
                'BaseInfo' => $this->BaseInfo,
            ],
            null
        );
        $this->eventDispatcher->dispatch(EccubeEvents::MAIL_ORDER, $event);

        $count = $this->mailer->send($message);

        $MailHistory = new MailHistory();
        $MailHistory->setMailSubject($message->getSubject())
            ->setMailBody($message->getBody())
            ->setOrder($Order)
            ->setSendDate(new \DateTime());

        // HTML?????????????????????
        $multipart = $message->getChildren();
        if (count($multipart) > 0) {
            $MailHistory->setMailHtmlBody($multipart[0]->getBody());
        }

        $this->mailHistoryRepository->save($MailHistory);

        log_info('????????????????????????????????????', ['count' => $count]);

        return $message;
    }

}
