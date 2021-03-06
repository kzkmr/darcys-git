<?php

declare(strict_types=1);

namespace ProxyManager\Signature;

use ProxyManager\Inflector\Util\ParameterEncoder;
use ProxyManager\Inflector\Util\ParameterHasher;

final class SignatureGenerator implements SignatureGeneratorInterface
{
    private $parameterEncoder;
    private $parameterHasher;

    public function __construct()
    {
        $this->parameterEncoder = new ParameterEncoder();
        $this->parameterHasher  = new ParameterHasher();
    }

    /**
     * {@inheritDoc}
     */
    public function generateSignature(array $parameters): string
    {
        return $this->parameterEncoder->encodeParameters($parameters);
    }

    /**
     * {@inheritDoc}
     */
    public function generateSignatureKey(array $parameters): string
    {
        return $this->parameterHasher->hashParameters($parameters);
    }
}
