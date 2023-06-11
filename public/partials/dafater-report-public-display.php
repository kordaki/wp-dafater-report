<pre>
<?php print_r($data); ?>
</pre>
<div class="container d-flex align-items-center justify-content-center">
    <form class="container" id="new-report-form">
        <div class="mb-3">
            <label for="user-name" class="form-label">گزارش دهنده:</label>
            <input type="text" name="user-name" value="<?php echo $user_name; ?>" class="form-control" id="user-name"
                aria-describedby="emailHelp" disabled>
        </div>
        <div class="mb-3">
            <label for="income" class="form-label">عملکرد (ریال):</label>
            <input type="text" name="income" class="form-control" id="income" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="year-selector" class="form-label">سال :</label>
            <select class="form-select" aria-label="سال" name="year" id="year-selector" disabled>
                <option value="1401">۱۴۰۱</option>
                <option value="1402" selected>۱۴۰۲</option>
                <option value="1403">۱۴۰۳</option>
                <option value="1404">۱۴۰۴</option>
                <option value="1405">۱۴۰۵</option>
                <option value="1406">۱۴۰۶</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="month-selector" class="form-label">ماه :</label>
            <select class="form-select" aria-label="ماه" name="month" id="month-selector" disabled>
                <?php foreach ($month_list as $key => $value) : ?>
                    <option value="<?php echo $key; ?>" <?php echo ($key == $active_month) ? 'selected' : ''; ?>><?php echo $value; ?></option>

                <?php endforeach; ?>
                
            </select>
        </div>
        <button type="submit" class="btn btn-primary">ذخیره</button>
    </form>
</div>