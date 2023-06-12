<!-- <pre>
<?php // print_r($data); ?>
</pre> -->
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