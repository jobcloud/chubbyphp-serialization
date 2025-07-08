<?php

declare(strict_types=1);

namespace Jobcloud\Serialization\ServiceFactory;

use Chubbyphp\DecodeEncode\Encoder\EncoderInterface;
use Chubbyphp\DecodeEncode\ServiceFactory\EncoderFactory;
use Chubbyphp\Laminas\Config\Factory\AbstractFactory;
use Jobcloud\Serialization\Normalizer\NormalizerInterface;
use Jobcloud\Serialization\Serializer;
use Jobcloud\Serialization\SerializerInterface;
use Psr\Container\ContainerInterface;

final class SerializerFactory extends AbstractFactory
{
    public function __invoke(ContainerInterface $container): SerializerInterface
    {
        /** @var NormalizerInterface $normalizer */
        $normalizer = $this->resolveDependency($container, NormalizerInterface::class, NormalizerFactory::class);

        /** @var EncoderInterface $encoder */
        $encoder = $this->resolveDependency($container, EncoderInterface::class, EncoderFactory::class);

        return new Serializer($normalizer, $encoder);
    }
}
