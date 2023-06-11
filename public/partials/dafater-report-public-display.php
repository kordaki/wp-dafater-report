<div class="container d-flex align-items-center justify-content-center">
<form class="container">
    <div class="mb-3">
        <label for="user-name" class="form-label">گزارش دهنده:</label>
        <input type="text" value="<?php echo $user_name; ?>" class="form-control" id="user-name" aria-describedby="emailHelp" disabled>
    </div>
    <div class="mb-3">
        <label for="income" class="form-label">عملکرد (ریال):</label>
        <input type="email" class="form-control" id="income" aria-describedby="emailHelp">
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
        <select name="month" class="form-select" aria-label="ماه" id="month-selector" disabled>
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
    <button type="submit" class="btn btn-primary">ذخیره</button>
</form>
</div>