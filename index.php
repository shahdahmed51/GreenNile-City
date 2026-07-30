<?php 
// تضمين ملف الهيدر العلوي
include 'includes/header.php'; 
?>

<!-- عناصر الخلفية التزيينية الشفافة في الزوايا -->
<div class="decor-leaf-top"><i class="bi bi-tree-fill"></i></div>
<div class="decor-leaf-bottom"><i class="bi bi-leaf"></i></div>

<!-- الحاوية المركزية المتمركزة في منتصف الشاشة تماماً -->
<div class="splash-container">
    <!-- أيقونة اللوجو البرمجية الكبيرة -->
    <div class="brand-logo">
        <i class="fa-brands fa-pagelines"></i>
    </div>
    
    <!-- النصوص التوضيحية للمشروع -->
    <h1 class="brand-title">GreenNile City</h1>
    <p class="slogan-text">Management System</p>
    <div class="slogan-sub-text">Smart Living, Better Tomorrow.</div>

    <!-- شريط ومؤشر التحميل التفاعلي -->
    <div class="progress-wrapper">
        <div class="d-flex justify-content-between loading-text">
            <span>Loading...</span>
            <span id="percentage-text">0%</span>
        </div>
        <div class="custom-progress">
            <div class="custom-progress-bar"></div>
        </div>
    </div>
</div>

<?php 
// تضمين ملف الفوتر السفلي
include 'includes/footer.php'; 
?>
