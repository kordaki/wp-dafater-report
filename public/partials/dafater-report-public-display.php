<pre>
<?php // print_r($user); ?>
<?php // print_r(get_user_meta($user->ID, 'moghasem')); ?>
</pre>

<div class="container">
    <?php if ($isUserLoggedIn) { ?>
        <form id="new-report-form">

            <h4>گزارش دهنده:
                <?php echo $user_name; ?>
            </h4>
            <h4>برای تاریخ:
                <?php echo $active_year, "/", $active_month; ?>
            </h4>

            <div class="alert alert-warning" role="alert">

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="nullIncome" id="null-income">
                    <label class="form-check-label" for="null-income">
                        بدون حق التحریر
                    </label>

                </div>

                در صورت عدم وجود حق التحریر، این گزارش را بدون مقدار درآمد ثبت کنید.
            </div>

            <table id="dynamicTable" class="table table-bordered">
                <thead class="table-info">
                    <tr>
                        <th scope="col">ردیف</th>
                        <th>معامل</th>
                        <th>متعامل</th>
                        <th>شماره سند</th>
                        <th>مبلغ حق التحریر (ریال)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr class="form-row">
                        <td class="table-index" scope="row">1</td>
                        <td>
                            <input type="text" class="form-control" name="moamel[]" placeholder="معامل">

                        </td>
                        <td>
                            <select class="form-control" name="moteamel[]">
                                <option value="" disabled selected>انتخاب کنید...</option>
                                <?php foreach ($moteamel_list as $moteamel): ?>
                                    <option value="<?php echo $moteamel; ?>"><?php echo $moteamel; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="documentNumber[]" placeholder="شماره سند">
                        </td>
                        <td>
                            <input type="number" class="form-control" name="income[]" placeholder="مبلغ به ریال">
                        </td>
                        <td>
                            <button type="button" class="btn btn-success addRow" id="addRow">+</button>
                        </td>
                    </tr>
                </tbody>
            </table>


            <input type="hidden" name="year" value="<?php echo $active_year ?>">
            <input type="hidden" name="month" value="<?php echo $active_month ?>">

            <div class="alert alert-info" role="alert">
                مجموع مبلغ حق التحریر: <b id="total-income"> 0 </b> ریال
            </div>

            <button type="submit" class="btn btn-lg btn-primary">
                <?php $is_edit ? print("بروزرسانی") : print("ذخیره") ?>
            </button>
        </form>

    <?php } else { ?>
        <div class="d-grid gap-2 col-6 mx-auto">
            برای ثبت گزارش، ابتدا وارد سایت شوید.
            <a href="<?php echo(home_url()); ?>/wp-admin" class="btn btn-primary" role="button">ورود</a>
        </div>
    <?php } ?>
</div>
<br /><br /><br /><br /><br />