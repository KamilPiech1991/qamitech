<?php 
    $title      = 'Instalacja pakietu sun-java6 jak na Ubuntu lucid';
    $category   = 'Kategoria';
    $autor      = 'Qamitech';
    $date       = '12 luty 2022';
    $image      = 'thumbs/instalacja-sun-java6.jpg'
?>

<?php require_once( '../include/header.php' ); ?>
<?php include( '../part/hero-single.php' ); ?>

<!-- BLOG SINGLE PAGE CONTENT -->

<section class="section section-content pb-medium">
  <div class="container-sm section-content__content content js-arts-split-text arts-split-text"
    data-arts-os-animation="true" 
    data-arts-os-animation-name="animateText"
    data-arts-os-animation-params="{stagger: {amount: 0.3, from: 'left'}}" 
    data-arts-split-text="lines"
    data-arts-split-text-set="lines" 
    data-arts-split-text-overflow-wrap="lines">
    <p>
    Jeśli chcesz zainstalować pakiet Sun <a href="https://pl.wikipedia.org/wiki/Java" target="_blank"> Java</a> 6 na Ubuntu Lucid, możesz postępować zgodnie z poniższymi krokami:
    </p>
    <p>
    Otwórz terminal i wpisz poniższą komendę, aby dodać oficjalne repozytorium Ubuntu Partner:
    </p>
    <blockquote>
    sudo add-apt-repository "deb http://archive.canonical.com/ lucid partner"
    </blockquote>
    <p>
    Następnie zaktualizuj listę pakietów przy użyciu komendy:
    </p>
    <blockquote>
    sudo apt-get update
    </blockquote>
    <p>
    Teraz możesz zainstalować pakiet Sun Java 6 przy użyciu polecenia:
    </p>
    <blockquote>
    sudo apt-get install sun-java6-jre sun-java6-plugin
    </blockquote>
    <p>
      Po zainstalowaniu pakietu Java, możesz sprawdzić jego wersję za pomocą polecenia:
    </p>
    <blockquote>
    java -version
    </blockquote>
    <p>
    Komenda ta powinna wyświetlić informacje o wersji zainstalowanej Javy.
    </p>
  </div>
</section>

</main>
<?php require_once( '../include/footer.php' ); ?>