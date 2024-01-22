
 <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
<script>
    AOS.init();
    

    $(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
            $('#dynamic').addClass('newClass');
            $('#dynamic').removeClass('p-5');
            $('#dynamic').addClass('p-3');
        }
        else {
            $('#dynamic').removeClass('newClass');
            $('#dynamic').removeClass('p-3');
            $('#dynamic').addClass('p-5');
        }
    });  
    
    
    var button=document.getElementById('wsh');
    console.log("gvhbj");
    button.addEventListener("click",function(){
        document.getElementById('wsh1').innerText="WISHLISTED";
    });
    var button1=document.getElementById('atc');
    button1.addEventListener("click",function(){
        document.getElementById('atc1').innerText="ADDED TO CART";
    });
    
    function openTab(tabName) {
        let i;
        let tabContent;
        
        tabContent = document.getElementsByClassName("tab-content");
        
        for (i = 0; i < tabContent.length; i++) {
            tabContent[i].style.display = "none";
        }
        
        document.getElementById(tabName).style.display = "flex";
    }

    // This needs to DRY'ed up so it can be used with a CMS
        
    let progressEl = document.getElementById("progress");
    let wishlistEl = document.getElementById("wishlist");
    let cartEl = document.getElementById("cart");
    let settingsEl = document.getElementById("settings");
    let ovl = document.getElementById("overview");
    let ntl = document.getElementById("notes");

    progressEl.addEventListener("click", function(){openTab("pro")}, false);
    wishlistEl.addEventListener("click", function(){openTab("wish")}, false);
    cartEl.addEventListener("click", function(){openTab("ca")}, false);
    settingsEl.addEventListener("click", function(){openTab("set")}, false);
    ovl.addEventListener("click", function(){openTab("ov")}, false);
    ntl.addEventListener("click", function(){openTab("nt")}, false);

</script>
  </body>
</html>