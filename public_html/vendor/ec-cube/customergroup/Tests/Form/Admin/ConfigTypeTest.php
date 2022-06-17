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

namespace Plugin\CustomerGroup\Tests\Form\Admin;


use Eccube\Tests\Form\Type\AbstractTypeTestCase;
use Plugin\CustomerGroup\Form\Type\Admin\ConfigType;
use Symfony\Component\Form\FormInterface;

class ConfigTypeTest extends AbstractTypeTestCase
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var array
     */
    protected $formData = [
        'optionGroupProductHidden' => 1,
        'optionGroupCategoryHidden' => 1
    ];

    public function setUp()
    {
        parent::setUp();

        $this->form = $this->formFactory
            ->createBuilder(ConfigType::class, null, [
                'csrf_protection' => false
            ])->getForm();
    }

    public function testValidData()
    {
        $this->form->submit($this->formData);
        self::assertTrue($this->form->isValid());
    }
}
