<?php
/**
 * This file is part of CustomerGroup
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroup\Controller\Admin;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormInterface;

class AbstractCsvImportController extends \Eccube\Controller\Admin\AbstractCsvImportController
{
    /**
     * @var ArrayCollection
     */
    protected $errors;

    public function __construct()
    {
        $this->errors = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|null
     */
    protected function getErrorMessages(): ?ArrayCollection
    {
        return $this->errors;
    }

    /**
     * @param string $message
     * @return $this
     */
    protected function addErrorMessage(string $message): self
    {
        $this->errors->add($message);

        return $this;
    }

    /**
     * @return bool
     */
    protected function hasErrorMessage(): bool
    {
        return $this->errors->count() > 0;
    }

    protected function renderWithError(FormInterface $form, array $headers, $rollback = true): array
    {
        if ($this->hasErrorMessage()) {
            if ($rollback) {
                $this->entityManager->getConnection()->rollBack();
            }
        }

        $this->removeUploadedFile();

        return [
            'form' => $form->createView(),
            'headers' => $headers,
            'errors' => $this->getErrorMessages()
        ];
    }
}
