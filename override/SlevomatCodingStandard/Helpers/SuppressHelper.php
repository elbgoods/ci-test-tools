<?php

declare(strict_types=1);

namespace SlevomatCodingStandard\Helpers;

use PHP_CodeSniffer\Files\File;
use SlevomatCodingStandard\Helpers\Annotation\Annotation;

class SuppressHelper
{
    public const ANNOTATION = '@phpcsSuppress';

    private const SUPPRESSED = [
        'SlevomatCodingStandard.TypeHints.ReturnTypeHint.UselessAnnotation',
        'SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingTraversableTypeHintSpecification',
        'SlevomatCodingStandard.TypeHints.ParameterTypeHint.UselessAnnotation',
        'SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingTraversableTypeHintSpecification',
        'SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint',
    ];

    public static function isSniffSuppressed(File $phpcsFile, int $pointer, string $suppressName): bool
    {
        if (in_array($suppressName, self::SUPPRESSED)) {
            return true;
        }

        return array_reduce(AnnotationHelper::getAnnotationsByName($phpcsFile, $pointer, self::ANNOTATION), static function (bool $carry, Annotation $annotation) use ($suppressName): bool {
            if ($annotation->getContent() === $suppressName || strpos($suppressName, sprintf('%s.', $annotation->getContent())) === 0) {
                $carry = true;
            }

            return $carry;
        }, false);
    }
}
