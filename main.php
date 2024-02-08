<!DOCTYPE html>
<html>
<head>
    <title>Photo Gallery</title>
    <link rel="stylesheet" href="stylemain.css" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function cambiaPagina(selected, filename){
            selected.setAttribute('id', 'selected');

            animazione(selected);

            
            setTimeout(function() {
                window.location.href="product.php?file="+filename;
            }, 2700);
            
        }

        function animazione(selected) {
            var body = document.body;
            var selectedClone = selected.cloneNode(true);
            var x= window.scrollX + selected.getBoundingClientRect().left;
            var y= window.scrollY + selected.getBoundingClientRect().top;
            
            document.body.setAttribute('style', 'position: relative;');
            console.log(selected.getBoundingClientRect());
            selectedClone.setAttribute('style', 'position: relative; top: '+y+'px; left: '+x+'px;');

            $('title').fadeOut('fast');
            $(body).children(':not(#selected)').fadeOut('1000', function() {
                body.innerHTML = ''; // Rimuovi tutti gli elementi dal body

                body.appendChild(selectedClone); // Inserisci l'elemento clonato nel body
                
                // ingrandisce l'immagine
                if($(window).width()>449){
                    $('#selected').animate({width: '61vh', height: '70vh'}, 1000);
                }
                
                // sposta l'immagine al centro della pagina
                setTimeout(function() {

                    var windowWidth = $(window).width();
                    var windowHeight = $(window).height();
                    windowHeight -= (windowHeight/100)*20; 

                    var divWidth = $('#selected').outerWidth();
                    var divHeight = $('#selected').outerHeight();
                    
                    var leftPosition = (windowWidth - divWidth) / 2;
                    var topPosition = ((windowHeight - divHeight) / 2);
                    

                    $('#selected').css({
                        'position': 'relative',
                        'left': leftPosition + 'px',
                        'top': topPosition + 'px'
                    });
                }, 850);
            });
        }
    </script>
</head>
<body>
    <h1>Photo Gallery</h1><br>
    
    <div id="containerP" class="containerP">
        <div id="products" class="products">
            <?php
                // Directory path
                $dir = 'Images/';

                // products data
                $data = json_decode(file_get_contents('products.json'));
                
                foreach ($data as $product){
                    echo '<div id="product">
                            <div id="pg" onclick="cambiaPagina( this,\''.$product->img.'\')">
                                <img src="' . $dir . $product->img . '" alt="' . $product->img . '">
                                <label id="description">'.$product->descr.'</label>
                                <label id="price">'.$product->price.'</label>
                            </div>
                          </div>';
                }
            ?>
        </div>
    </div>
</body>
</html>     