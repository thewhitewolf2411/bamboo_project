$('#sell-mobile-phones').on('click', function(){
    window.location = '/sell';
    localStorage.setItem('preselectedSellCategory', 'mobile');
});
$('#sell-watches').on('click', function(){
    window.location = '/sell';
    localStorage.setItem('preselectedSellCategory', 'watches');
});
$('#sell-tablets').on('click', function(){
    window.location = '/sell';
    localStorage.setItem('preselectedSellCategory', 'tablets');
});

$(".sell-category-wrapper")
.on('mouseenter', function() {
    // background - 1
    let bg = this.childNodes[1];
    bg.classList.add('small');
    // image - 3
    let img = this.childNodes[3];
    img.classList.add('enlarged');
    // shadow - 5
    let shadow = this.childNodes[5];
    shadow.classList.add('zoomed');
})
.on('mouseleave', function() {
    //unfocusCategory(this);
    // background - 1
    let bg = this.childNodes[1];
    bg.classList.remove('small');
    // image - 3
    let img = this.childNodes[3];
    img.classList.remove('enlarged');
    // shadow - 5
    let shadow = this.childNodes[5];
    shadow.classList.remove('zoomed');
});