<?php
class Helper_Date
{

    public static function get_active_date()
    {
        $date = parsidate('Y m', $datetime = '-1 month', $lang = 'eng');
        $date = $date . " 01";
        return $date;
    }

    public static function get_active_year()
    {
        $date = self::get_active_date();
        $date = explode(' ', $date);
        $month = $date[0];
        return $month;
    }

    public static function get_active_month()
    {
        $date = self::get_active_date();
        $date = explode(' ', $date);
        $month = $date[1];
        return $month;
    }


    // used for saving into DB
    public static function get_active_date_europe()
    {
        $active_date = self::get_active_date();
        return gregdate('Y-m-d', $active_date);
    }

    public static function shamsi_to_europe_date($year, $month, $day = '01')
    {
        $date = $year . ' ' . $month . ' ' . $day;
        return gregdate('Y-m-d', $date);
    }


    // to read from db
    public static function get_persian_date($date)
    {
        $date = parsidate('Y m d', $datetime = $date, $lang = 'eng');
        return $date;
    }
    public static function get_persian_date_array($date)
    {
        $date = parsidate('Y m', $datetime = $date, $lang = 'eng');
        $date = explode(' ', $date);
        $year = $date[0];
        $month = $date[1];
        return array(
            'year' => $year,
            'month' => $month,
        );
    }

    public static function get_month_list()
    {
        return array(
            '01' => 'فروردین',
            '02' => 'اردیبهشت',
            '03' => 'خرداد',
            '04' => 'تیر',
            '05' => 'مرداد',
            '06' => 'شهریور',
            '07' => 'مهر',
            '08' => 'آبان',
            '09' => 'آذر',
            '10' => 'دی',
            '11' => 'بهمن',
            '12' => 'اسفند',
        );
    }

    public static function get_year_list()
    {
        return array(
            '1400' => '۱۴۰۰',
            '1401' => '۱۴۰۱',
            '1402' => '۱۴۰۲',
            '1403' => '۱۴۰۳',
            '1404' => '۱۴۰۴',
            '1405' => '۱۴۰۵',
            '1406' => '۱۴۰۶',
            '1407' => '۱۴۰۷',
            '1408' => '۱۴۰۸',
        );
    }

    // public static function get_active_month_list()
    // {
    //     $date = parsidate('Y m', $datetime = '-1 month', $lang = 'eng');
    //     $date = explode(' ', $date);
    //     $year = $date[0];
    //     $month = $date[1];
    //     $month_list = self::get_month_list();
    //     $month_list = array(
    //         $month => $month_list[$month],
    //     );
    //     return $month_list;
    // }

    public static function get_moteamel_list()
    {
        return array(
            'بانک مسکن',
            'بانک ملی',
            'بانک سپه',
            'بانک رفاه',
            'بانک صنعت و معدن',
            'بانک کشاورزی',
            'پست بانک',
            'بانک توسعه تعاون',
            'شهرداری',
            'مسکن و شهرسازی',
            'انتقال اجرایی',
            'دولت جمهوری اسلامی',
            'شرکت نفت',
            'بنیاد مسکن',
            'وزارت علوم',
            'سازمان جنگلها و مراتع',
            'سازمان تاکسیرانی',
            'جهاد کشاورزی',
            'اداره اوقاف',
            'صندوق مهر امام رضا',
            'سایر',
        );
    }
}

?>