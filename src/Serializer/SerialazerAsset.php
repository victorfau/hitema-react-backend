<?php
/**
 * Copyright lesson
 * author: Victor FAU
 * contact: victrrfau@gmail.com
 */

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

$encoders = [new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);
