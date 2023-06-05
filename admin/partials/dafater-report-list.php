<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://kordaki.net
 * @since      1.0.0
 *
 * @package    Dafater_Report
 * @subpackage Dafater_Report/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<h1>گزارش عملکرد</h1>

<div class="container-fluid">

    <div class="">
        <form id="search-reports-form" class="row gx-5">
            <div class="col">
                <div class="row">
                    <label class="col-sm-2 col-form-label" for="year-selector">
                        سال:
                    </label>
                    <select name="year" class="form-select col-sm-3" aria-label="سال" id="year-selector">
                        <option value="1401" selected>1401</option>
                        <option value="1402">1402</option>
                        <option value="1403">1403</option>
                        <option value="1404">1404</option>
                        <option value="1405">1405</option>
                        <option value="1406">1406</option>
                    </select>
                </div>

            </div>
            <div class="col">
                <div class="row">
                    <label class="col-sm-2 col-form-label" for="month-selector">
                        ماه:
                    </label>
                    <select name="month" class="form-select col-sm-3" aria-label="ماه" id="month-selector">
                        <option value="1" selected>فروردین</option>
                        <option value="2">اردیبهشت</option>
                        <option value="3">خرداد</option>
                        <option value="4">تیر</option>
                        <option value="5">مرداد</option>
                        <option value="6">شهریور</option>
                        <option value="7">مهر</option>
                        <option value="8">آبان</option>
                        <option value="9">آذر</option>
                        <option value="10">دی</option>
                        <option value="11">بهمن</option>
                        <option value="12">اسفند</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <button type="submit" id="show-reports" class="btn btn-primary mb-3">نمایش</button>
            </div>
        </form>
    </div>



    <table id="report_table" class="report-table display " style="width:100%">
        <thead>
            <tr>
                <th>ردیف</th>
                <th>دفترخانه</th>
                <th>ماه</th>
                <th>درآمد</th>
                <th>تاریخ ثبت</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($reports) > 0) {
                foreach ($reports as $report) {
                    echo "<tr>";
                    echo "<td>" . $report->id . "</td>";
                    echo "<td>" . $report->display_name . "</td>";
                    echo "<td>" . $report->pdate . "</td>";
                    echo "<td>" . $report->income . "</td>";
                    echo "<td>" . $report->pcreated_at . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ردیف</th>
                <th>دفترخانه</th>
                <th>ماه</th>
                <th>درآمد</th>
                <th>تاریخ ایجاد</th>
            </tr>
        </tfoot>
    </table>

</div>