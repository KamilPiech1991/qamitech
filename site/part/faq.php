<?php
/* Sekcja FAQ: wyświetla pytania z $faq (te same trafiają do schema FAQPage w header.php). */
if (empty($faq)) {
    return;
}
?>
<section class="section section-content pb-large faq-section" id="faq">
   <div class="container">
      <div class="row">
         <div class="col-lg-8">
            <h2 class="h3 mb-4"><?php echo htmlspecialchars($faqTitle ?? 'Najczęstsze pytania', ENT_QUOTES, 'UTF-8'); ?></h2>
            <div class="faq-list">
<?php foreach ($faq as $i => $item) : ?>
               <details class="faq-item"<?php echo $i === 0 ? ' open' : ''; ?>>
                  <summary class="faq-item__question"><h3 class="h5"><?php echo htmlspecialchars($item['q'], ENT_QUOTES, 'UTF-8'); ?></h3></summary>
                  <div class="faq-item__answer"><p><?php echo $item['a']; ?></p></div>
               </details>
<?php endforeach; ?>
            </div>
         </div>
      </div>
   </div>
</section>
