<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
/* Premium Boite a Idees Design */
body {
    background-color: var(--bg, #f7faf8);
    margin: 0;
    padding: 0;
    font-family: var(--font-family, 'Inter', sans-serif);
    padding-bottom: 120px; /* space for footer */
}

/* Header */
.page-header {
    background: #ffffff;
    padding: 24px 20px 20px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 20px rgba(0, 50, 30, 0.05);
    border-bottom: 1px solid #d4e0d9;
}

.header-top {
    display: flex;
    align-items: center;
    gap: 16px;
}

.btn-back {
    width: 40px; height: 40px;
    border-radius: 12px;
    background: #f4f8f6;
    display: flex; align-items: center; justify-content: center;
    color: #1a2e24;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-back:hover {
    background: #e6f5ee;
    color: #006241;
}

.header-title {
    font-size: 20px;
    font-weight: 700;
    color: #1a2e24;
    margin: 0;
}

/* Illustration Area */
.hero-illustration {
    padding: 40px 20px 20px;
    text-align: center;
}

.icon-wrapper {
    width: 80px; height: 80px;
    background: #e6f5ee;
    border-radius: 24px;
    display: flex; align-items: center; justify-content: center;
    color: #006241;
    font-size: 32px;
    margin: 0 auto 20px;
    box-shadow: 0 8px 24px rgba(0, 98, 65, 0.15);
}

.hero-text h2 {
    font-size: 22px;
    font-weight: 700;
    color: #1a2e24;
    margin: 0 0 8px 0;
}

.hero-text p {
    font-size: 15px;
    color: #5a6b63;
    line-height: 1.5;
    margin: 0;
}

/* Form Area */
.form-container {
    padding: 20px;
}

.premium-textarea {
    width: 100%;
    background: #ffffff;
    border: 1.5px solid #d4e0d9;
    border-radius: 16px;
    padding: 16px;
    font-size: 15px;
    font-family: inherit;
    color: #1a2e24;
    resize: none;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(0, 50, 30, 0.03);
}

.premium-textarea:focus {
    outline: none;
    border-color: #006241;
    box-shadow: 0 4px 16px rgba(0, 98, 65, 0.08);
}

.premium-textarea::placeholder {
    color: #8a9b93;
}

/* Fixed Footer */
.fixed-footer {
    position: fixed;
    bottom: 0; left: 0; width: 100%;
    background: white;
    padding: 16px 20px 24px;
    border-top: 1px solid #d4e0d9;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.05);
    z-index: 99;
}

.btn-main-action {
    background: linear-gradient(135deg, #006241, #00875A);
    color: white;
    width: 100%;
    border: none;
    border-radius: 16px;
    padding: 16px;
    font-size: 16px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(0, 98, 65, 0.25);
    transition: all 0.2s;
    text-align: center;
    cursor: pointer;
}

.btn-main-action:hover {
    background: linear-gradient(135deg, #004d33, #006241);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 98, 65, 0.3);
}
</style>

<!-- Header -->
<div class="page-header">
    <div class="header-top">
        <a href="<?php echo $this->Html->url(array("action" => "index", $code)); ?>" class="btn-back btn_spiner">
            <i data-lucide="chevron-left"></i>
        </a>
        <h1 class="header-title">Boîte à idées</h1>
    </div>
</div>

<!-- Illustration & Text -->
<div class="hero-illustration">
    <div class="icon-wrapper">
        <i data-lucide="lightbulb"></i>
    </div>
    <div class="hero-text">
        <h2>Partagez vos idées</h2>
        <p>Nous sommes impatients de découvrir vos suggestions créatives pour améliorer nos services.</p>
    </div>
</div>

<!-- Form -->
<form action="<?php echo $this->Html->url(array("action" => "boite", $code)); ?>" method="post" enctype="multipart/form-data">
    <div class="form-container">
        <?php echo $this->Form->textarea('Boiteidee.name', [
            'class' => 'premium-textarea', 
            'rows' => '6', 
            'placeholder' => 'Écrivez votre idée ou suggestion ici...'
        ]); ?>
    </div>
    
    <div class="fixed-footer">
        <button type="submit" class="btn-main-action btn_spiner">
            <i data-lucide="send" style="margin-right: 8px;"></i> Envoyer
        </button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>