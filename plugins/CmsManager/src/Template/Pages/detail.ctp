<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $page
 */

?>
<?php
if (!empty($page->banner) && file_exists($_dir . $page->banner)) {
    $this->start('parallaxBanner');
    ?>
    <section id="hero">
        <div class="hero-container">
            <h1>Welcome to Regna</h1>
            <h2>We are team of talanted designers making websites with Bootstrap</h2>
            <a href="#about" class="btn-get-started">Get Started</a>
        </div>
    </section><!-- #hero -->
    <?php
    $this->end();
}
?>
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle"><?= h($page->title) ?></h2>
            </div>
        </div>
    </div>
</section>
<div class="container">
         <div class="about">
            <?= $this->Text->autoParagraph($page->description); ?>
        </div>
</div>
<?php
$this->assign('title', $page->meta_title);
$this->Html->meta(
    'keywords', $page->meta_keyword, ['block' => true]
);
$this->Html->meta(
    'description', $page->meta_description, ['block' => true]
);

?>