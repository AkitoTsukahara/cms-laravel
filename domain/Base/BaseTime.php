<?php

declare(strict_types=1);

namespace Domain\Base;

use Domain\Common\Day;
use Domain\Common\DayOfTheWeek;
use Domain\Common\Month;
use Domain\Common\Year;

abstract class BaseTime
{
    private int $timestamp;
    private static ?int $mockedCurrentTimestamp = null;

    public function __construct(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public static function fromString(string $string): static
    {
        $time = strtotime($string);
        if ($time === false) {
            throw new \InvalidArgumentException("'${string}' is strtotime failed");
        }
        return new static($time);
    }

    public static function now(): static
    {
        if (self::$mockedCurrentTimestamp !== null) {
            return new static(self::$mockedCurrentTimestamp);
        }
        return new static(time());
    }

    public static function mockCurrentTime(string $stringTime): void
    {
        self::$mockedCurrentTimestamp = strtotime($stringTime);
    }

    public static function unMockCurrentTime(): void
    {
        self::$mockedCurrentTimestamp = null;
    }

    public function isEqual(BaseTime $another): bool
    {
        return $this->timestamp === $another->timestamp;
    }

    public function isEqualDay(BaseTime $another): bool
    {
        return $this->atHour(0)->isEqual($another->atHour(0));
    }

    public function isEarlierThan(BaseTime $another): bool
    {
        return $this->timestamp < $another->timestamp;
    }

    public function isLaterThan(BaseTime $another): bool
    {
        return $this->timestamp > $another->timestamp;
    }

    public function isWithinAPastDay(BaseTime $another): bool
    {
        $backOneDay = $this->backOneDay();

        return $another->isEqual($this)
            || $another->isEqual($backOneDay)
            || ($another->isEarlierThan($this) && $another->isLaterThan($backOneDay)); // $thisより前で$thisの24時間より後
    }

    public function remainingDaysTo(BaseTime $another): int
    {
        $remainingTime = $another->atHour(0)->timestamp - $this->atHour(0)->timestamp;

        // 残り日数なので、過ぎていたら0日
        if ($remainingTime < 0) {
            return 0;
        }

        return $remainingTime / 86400;
    }

    public function atHour(int $hour): static
    {
        return new static(strtotime(date('Y-m-d ' . $hour . ':00:00', $this->timestamp)));
    }

    public function startOfHour(): static
    {
        return new static(strtotime(date('Y-m-d H' . ':00:00', $this->timestamp)));
    }

    public function endOfHour(): static
    {
        return new static(strtotime(date('Y-m-d H' . ':59:59', $this->timestamp)));
    }

    public function startOfDay(): static
    {
        return new static(strtotime(date('Y-m-d ' . '00:00:00', $this->timestamp)));
    }

    public function endOfDay(): static
    {
        return new static(strtotime(date('Y-m-d ' . '23:59:59', $this->timestamp)));
    }

    public function addOneHour(): static
    {
        return new static(strtotime('+1 hour', $this->timestamp()));
    }

    public function day(): static
    {
        return new static(strtotime(date('Y-m-d', $this->timestamp)));
    }

    public function addOneDay(): static
    {
        return self::addDays(1);
    }

    public function addDays(int $days): static
    {
        return new static(strtotime('+' . $days . ' day', $this->timeStamp()));
    }

    public function subDays(int $days): static
    {
        return new static(strtotime('-' . $days . 'day', $this->timestamp()));
    }

    public function subHours(int $hour): static
    {
        return new static(strtotime('-' . $hour . 'hour', $this->timestamp()));
    }

    public function addMinutes(int $minute): static
    {
        return new static(strtotime('+' . $minute . 'minute', $this->timestamp()));
    }

    public function subMinutes(int $minute): static
    {
        return new static(strtotime('-' . $minute . 'minute', $this->timestamp()));
    }

    public function addSeconds(int $second): static
    {
        return new static(strtotime('+' . $second . 'second', $this->timestamp()));
    }

    public function subSeconds(int $second): static
    {
        return new static(strtotime('-' . $second . 'second', $this->timestamp()));
    }

    public function nextDay(): static
    {
        return new static(strtotime('+1 day', $this->day()->timestamp()));
    }

    public function backOneDay(): static
    {
        return new static(strtotime('-1 day', $this->timestamp()));
    }

    public function lastTimeOfMonth(): static
    {
        return new static(strtotime(date('Y-m-t 23:59:59', $this->timeStamp())));
    }

    public function nextYear(): static
    {
        return new static(strtotime('+1 year', $this->timestamp));
    }

    public function thirtyDaysAgo(): static
    {
        return new static(strtotime('-30 day', $this->timestamp));
    }

    /* 1ヶ月前の初日を取得する。必ず月をまたぐ 7/31 -> 6/1  */
    public function firstDayOfPrevMonth(): static
    {
        return new static(strtotime('first day of previous month', $this->timestamp));
    }

    public function timeStamp(): int
    {
        return $this->timestamp;
    }

    public function getDay(): Day
    {
        return new Day(intval(date('d', $this->timestamp)));
    }

    public function getMonth(): Month
    {
        return new Month(intval(date('m', $this->timestamp)));
    }

    public function getYear(): Year
    {
        return new Year(intval(date('Y', $this->timestamp)));
    }

    // FIXME: Hour 型を作成して戻り値を直した方が良い。
    public function getHour(): string
    {
        return date('H', $this->timestamp);
    }

    public function getWithTime(): string
    {
        return date('m/d H:i', $this->timestamp);
    }

    public function getDisplayName(): string
    {
        return date('Y/m/d', $this->timestamp);
    }

    public function getDetailed(): string
    {
        return date('Y/m/d H:i:s', $this->timestamp);
    }

    public function getSqlDate(): string
    {
        return date('Y-m-d', $this->timestamp);
    }

    public function getSqlTimestamp(): string
    {
        // 日付の表示は「/」区切りで統一するため、本メソッドは表示用に使わないこと
        return date('Y-m-d H:i:s', $this->timestamp);
    }

    public function getHtmlDateTime(): string
    {
        // 日付の表示は「/」区切りで統一するため、本メソッドは表示用に使わないこと
        return date('Y-m-d', $this->timestamp);
    }

    public function getYmdHi(): string
    {
        return date('Y/m/d H:i', $this->timestamp);
    }

    public function getJapaneseYm(): string
    {
        return date('Y年m月', $this->timestamp);
    }

    public function getJapaneseYmd(): string
    {
        return date('Y年m月d日', $this->timestamp);
    }

    public function getForGoogleApi(): string
    {
        // 標準時にして使うので9時間戻す
        return date('Y-m-d\TH:i:s\Z', $this->timestamp - 60 * 60 * 9);
    }

    public function getForElasticsearch(): string
    {
        // Elasticsearch のフォーマットに合わせたものである必要がある。
        // https://www.elastic.co/guide/en/elasticsearch/reference/6.7/mapping-date-format.html
        // こちらの date_hour_minute_second に対応するもの
        return date('Y-m-d\TH:i:s', $this->timestamp);
    }

    public function getForApi(): string
    {
        return $this->getRFC3339JSTFormat();
    }

    public function getForJsonLd(): string
    {
        return $this->getRFC3339JSTFormat();
    }

    public function getRFC3339JSTFormat(): string
    {
        return date('Y-m-d\TH:i:s\+09:00', $this->timestamp);
    }

    public function getFormattedDate(string $format): string
    {
        return date($format, $this->timestamp);
    }

    public function rawValue(): int
    {
        return $this->timestamp;
    }

    public function getDayOfTheWeek(): DayOfTheWeek
    {
        return new DayOfTheWeek((int)date('w', $this->timestamp));
    }

    public function __toString(): string
    {
        return $this->getDisplayName();
    }
}
