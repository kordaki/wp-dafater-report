<!-- <pre>
<?php // print_r($data); ?>
</pre> -->


<div class="container">

    <h4>گزارش دهنده:
        <?php echo $user_name; ?>
    </h4>
    <h4>برای تاریخ:
        <?php echo $active_year, "/", $active_month; ?>
    </h4>

    <div class="alert alert-warning" role="alert">

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="null-income" value="" id="null-income">
            <label class="form-check-label" for="defaultCheck1">
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
                    <select class="form-control" name="moamel[]">
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" name="moteamel[]" placeholder="متعامل">
                </td>
                <td>
                    <input type="text" class="form-control" name="documentNumber[]" placeholder="شماره سند">
                </td>
                <td>
                    <input type="text" class="form-control" name="income[]" placeholder="مبلغ به ریال">
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

</div>










<div class="container d-flex align-items-center justify-content-center">
    <form class="container" id="new-report-form">
        <div class="mb-3">
            <label for="user-name" class="form-label">گزارش دهنده:</label>
            <input type="text" name="user-name" value="<?php echo $user_name; ?>" class="form-control" id="user-name"
                aria-describedby="emailHelp" disabled>
        </div>
        <div class="mb-3">
            <label for="income" class="form-label">عملکرد (ریال):</label>
            <input type="text" name="income" value="<?php $is_edit ? print($report->income) : print('') ?>"
                class="form-control" id="income">
        </div>
        <div class="mb-3">
            <label for="year-selector" class="form-label">سال :</label>
            <select class="form-select" aria-label="سال" name="year" id="year-selector" disabled>
                <?php foreach ($year_list as $key => $value): ?>
                    <option value="<?php echo $key; ?>" <?php echo ($key == $active_year) ? 'selected' : ''; ?>><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="month-selector" class="form-label">ماه :</label>
            <select class="form-select" aria-label="ماه" name="month" id="month-selector" disabled>
                <?php foreach ($month_list as $key => $value): ?>
                    <option value="<?php echo $key; ?>" <?php echo ($key == $active_month) ? 'selected' : ''; ?>><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php if ($is_edit): ?>
            <input type="hidden" name="target" value="da_update_report">
            <input type="hidden" name="id" value="<?php echo $report->id; ?>">
        <?php else: ?>
            <input type="hidden" name="target" value="da_add_report">
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">
            <?php $is_edit ? print("بروزرسانی") : print("ذخیره") ?>
        </button>
    </form>
</div>