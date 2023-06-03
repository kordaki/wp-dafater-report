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
        <div class="row gx-5">
            <div class="col">
                <div class="row">
                    <label class="col-sm-2 col-form-label" for="year-selector">
                        سال:
                    </label>
                    <select class="form-select col-sm-3" aria-label="سال" id="year-selector">
                        <option value="1" selected>1401</option>
                        <option value="2">1402</option>
                        <option value="3">1403</option>
                        <option value="4">1404</option>
                        <option value="5">1405</option>
                        <option value="6">1406</option>
                    </select>
                </div>

            </div>
            <div class="col">
                <div class="row">
                    <label class="col-sm-2 col-form-label" for="month-selector">
                        ماه:
                    </label>
                    <select class="form-select col-sm-3" aria-label="ماه" id="month-selector">
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
                <button type="submit" class="btn btn-primary mb-3">نمایش</button>
            </div>
        </div>
    </div>





    <table id="example" class="report-table display " style="width:100%">
        <thead>
            <tr>
                <th>دفترخانه</th>
                <th>ماه</th>
                <th>درآمد</th>
                <th>تاریخ ایجاد</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>دفترخانه شانزده</td>
                <td>1401/12</td>
                <td>$170,750</td>
                <td>2011-07-25</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>دفترخانه</th>
                <th>ماه</th>
                <th>درآمد</th>
                <th>تاریخ ایجاد</th>
            </tr>
        </tfoot>
    </table>

</div>