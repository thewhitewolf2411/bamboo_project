edit category

<script>

$(document).ready(function(){

    var elem = $('.portal-links-container > .portal-header-element')[1];
    
    console.log(elem.children[0]);

    elem.children[0].style.color = "#fff";
    elem.children[0].children[0].style.opacity = 1;

});

</script>