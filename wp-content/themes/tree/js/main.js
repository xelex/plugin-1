
console.log('start');

var postList=document.querySelector('.cat-list');

if(postList){
	postList.addEventListener('click',function(event){
		var listItem=event.target.closest('.catList-item');
		if(listItem){
			// postContentLoad(listItem);
		};
	});
};

function postContentLoad(clickPost){
	console.log(clickPost);
	var domen=location.hostname;
	idPosts=clickPost.querySelector('.idpost').innerHTML;
	console.log(idPosts);
	url='http://'+domen+'/wp-json/wp/v2/posts/'+idPosts;
	console.log(url);
	
	var xhr = new XMLHttpRequest();
	xhr.open('GET', url, false);
	xhr.send();
	if (xhr.status != 200) {
	  alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
	} else {
	  // alert( xhr.responseText ); 
	  console.log(xhr.responseText );
	  postContent_Render(xhr.responseText);
	}
}


function modal_box(id_form_hover){
        var id_element = id_form_hover;
        var currentScroll = jQuery(window).scrollTop();
        var windowsHeight = window.innerHeight;
        var height_block = jQuery('#'+id_element).outerHeight();
        var padding_ofset = (parseInt(windowsHeight)-parseInt(height_block))/2;
        
        if(padding_ofset>0){
              el_ofset = parseInt(currentScroll)+parseInt(padding_ofset);
        }
        else{
              el_ofset = parseInt(currentScroll)+10;
        }
        
        jQuery('#overlay_form').fadeIn('fast',function(){
                        jQuery('#'+id_element).animate({'top':el_ofset+'px'},500);
                });
      return false;       
}
    
function close_all(){
        jQuery(overlay_form).fadeOut('fast');
        jQuery('.modal-window').each(function(){
          
          jQuery(this).animate({'top':'-2000px'},500);
        });
        jQuery('.alert').each(function(){
          
          jQuery(this).fadeOut('fast');
        });        
        return false;
}


function postContent_Render(data){
	data=JSON.parse(data)
	console.log(data.title);
	var contentWindow=document.querySelector('#modal-posts-window');
	var modal_gallery='<div class="modal_gallery">';
	
	if(data.acf.post_galery){
		data.acf.post_galery.forEach(function(item,index,arr){
			console.log(item.ID);
			modal_gallery=modal_gallery+'<div class="modal_gallery_item"><img src="'+item.sizes.medium_large+'"></div>';
		});
	};
	modal_gallery=modal_gallery+'</div>';
	contentWindow.innerHTML='<h1>'+data.title.rendered+'</h1>'+modal_gallery+'<div class="modal-post-content">'+data.content.rendered+'</div>';
	modalPostGalery_render();
	modal_box('modal-posts-window');
}

function modalPostGalery_render(){
	jQuery('.modal_gallery').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});
}

	jQuery('.post-page-gallery').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});

document.addEventListener("DOMContentLoaded", function() {
    var inputs=document.querySelectorAll('.form-container input');
    inputs.forEach(function(input,index,arr){
        input.addEventListener('blur',function(){
            if (this.value!='') {
                this.classList.add('notempty');
            }else{
                this.classList.remove('notempty');
            }
        });
     });
  });


document.querySelector('.mobile-toogleMenu-bnt').addEventListener('click',function(e){
	var menu=document.querySelector('.sidebar-block');
	menu.classList.toggle('active');
});
document.querySelector('.close-menu-btn').addEventListener('click',function(e){
	var menu=document.querySelector('.sidebar-block');
	menu.classList.toggle('active');
});
document.querySelector('.header-tagsList-fullButton').addEventListener('click',function(e){
	var menu=document.querySelector('.header-tagsList_hidden');
	var menuButton=document.querySelector('.header-tagsList-fullButton');
	menuButton.classList.toggle('active');
	menu.classList.toggle('active');
})


document.querySelector('.header-page-search.mobile').addEventListener('click',function(e){
	console.log(e.target);
	
	if(e.target.classList.contains('closeIcon')){
		this.classList.remove('active');
		console.log('x');
	}else{
		// console.log(searchForm);
		if(!this.classList.contains('active')){
			this.classList.add('active');
		};
	};
});


