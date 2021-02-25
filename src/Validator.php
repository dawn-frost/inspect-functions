<?php

namespace DawnFrost\Inspect;

class Validator
{
    // 邮箱验证
    public static function isEmail(string $value): bool
    {
        return (bool) false !== filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    // 手机号验证
    public static function isMobile(string $value): bool
    {
        return (bool) preg_match('/^1[3-9]\d{9}$/', $value);
    }

    // 最大长度验证
    public static function maxCharLength(string $value, int $maxLength = 10): bool
    {
        return (bool) mb_strlen($value, 'utf-8') <= $maxLength;
    }

    // 长度验证
    public static function betweenCharLength(string $value, int $minLength = 5, int $maxLength = 10): bool
    {
        $length = mb_strlen($value, 'utf-8');
        if ($length < $minLength || $length > $maxLength) {
            return false;
        }

        return true;
    }

    // json字符串验证
    public static function isJson(string $string): array
    {
        $jData = json_decode($string, true);

        if (JSON_ERROR_NONE == json_last_error() && is_array($jData) && !empty($jData)) {
            return ['isJson' => true, 'data' => $jData];
        }

        return ['isJson' => false];
    }

    // 中文、英文、数字验证
    public static function chineseAlphaNumeric(string $value): bool
    {
        return (bool) preg_match('/^([\x{4e00}-\x{9fa5}]|[a-zA-Z0-9])*$/u', $value);
    }

    // 小写字母验证
    public static function isLowerAlpha(string $value): bool
    {
        return (bool) preg_match('/^[a-z]+$/', $value);
    }

    // 大写字母验证
    public static function isUpperAlpha(string $value): bool
    {
        return (bool) preg_match('/^[A-Z]+$/', $value);
    }

    // 整型数字验证
    public static function isInt($value, int $minInt = \PHP_INT_MIN, int $maxInt = \PHP_INT_MAX): bool
    {
        if (!\is_numeric($value) || $value > $maxInt || $value < $minInt) {
            return false;
        }

        $value = $value + 0; // 转义为 int 或 float 类型
        if (\is_int($value) && $value >= $minInt && $value <= $maxInt) {
            return true;
        }

        return false;
    }

    // 时间戳验证
    public static function isTimestamp($timestamp): bool
    {
        if ((string) strtotime(date('Y-m-d H:i:s', $timestamp)) === $timestamp) {
            return true;
        }

        return false;
    }

    // 日期验证
    public static function isDate(string $date, string $format = 'Y-m-d')
    {
        if ((string) date($format, strtotime($date)) === $date) {
            return true;
        }

        return false;
    }
}
