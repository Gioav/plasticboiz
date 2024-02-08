<?php
    $product= null;
    
    if(isset($_GET['file'])== false){
        header('Location: mainProdotti.php');
        die();
    }
    else{
        $data= json_decode(file_get_contents('products.json'));

        foreach($data as $products){
            if($products->img== $_GET['file']){
                $product= $products;
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>

        <link rel="stylesheet" href="product.css" media="screen">
        <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
        </script>
    </head>
    <body>
        <div id="">
            <?php
                echo '<div id="modelDiv"><model-viewer id="model3D" alt="fantasma" src="3D/'.$product->model3d.'" camera-controls touch-action="pan-y"></model-viewer></div>';

                echo '<a href="3D/'.$product->model3d.'" download="3D/'.$product->model3d.'"><button type="button">Scarica il modello 3D</button></a>';

                ?>
        </div>

        <script>
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            windowHeight -= (windowHeight/100)*20; 

            var divWidth = $('#model3D').outerWidth();
            var divHeight = $('#model3D').outerHeight();
            
            var leftPosition = (windowWidth - divWidth) / 2;
            var topPosition = ((windowHeight - divHeight) / 2);
            

            $('#modelDiv').css({
                'position': 'relative',
                'left': leftPosition + 'px',
                'top': topPosition + 'px'
            });

            var modello= document.querySelector('#model3D');
            const [material]= modello.model.materials;
            material.pbrMetallicRoughness.setBaseColorFactor('#0000ff');
        </script>
    </body>
</html>