$(function(){
	$('#header').load('header.php');
	$('#footer').load('footer.php');
});
var loginName = null;
$('#bt-login').click(function(){
	$.ajax({
		type: 'POST',
		url:'data/1_login.php',
		data:$('#login-form').serialize(),
		success:function(obj){
			if(obj.code===1000){
				$('.modal').fadeOut();
				loginName = $('[name="uname"]').val();
				$('#welcome').html('欢迎回来：'+loginName);
			}else{
				$('.modal .alert').html(obj.msg);
			}
		}
	});
});
$(function(){
	$('#header').on('click','#putDn',function(e){
		e.preventDefault();
		$('.modal').show();
	});
});
$(function(){
	loadProduct(1);
});
$('.pager').on('click','a',function(e){
	e.preventDefault();
	var pno=$(this).attr('href');
	loadProduct(pno);
	$(this).parent().addClass('active');
	$(this).parent().siblings('.active').removeClass('active');
});
function loadProduct(pno){
	$.getJSON('data/1_product_select.php',{'pno':pno},function(pager){
		var html='';
		$.each(pager.data,function(i,product){
			html+=`
				<li>
					<a href=""><img src="${product.pic}" alt=""/></a>
					<p>￥${product.price}</p>
					<h1><a href="">${product.pname}</a></h1>
					<div>
						<a href="" class="contrast"><i></i>对比</a>
						<a href="" class="p-operate"><i></i>关注</a>
						<a href="${product.pid}" class="addcart"><i></i>加入购物车</a>
					</div>
				</li>	
			`;
		});
		$('#plist>ul').html(html);
		var pagerHtml='';
		if(pager.pno-2>0){
			pagerHtml+=`<li><a href="${pager.pno-2}">${pager.pno-2}</a></li>`;
		}
		if(pager.pno-1>0){
			pagerHtml+=`<li><a href="${pager.pno-1}">${pager.pno-1}</a></li>`;
		}
		pagerHtml+=`<li class="active"><a href="${pager.pno}">${pager.pno}</a></li>`;
		if(pager.pno+1<=pager.pageCount){
			pagerHtml+=`<li><a href="${pager.pno+1}">${pager.pno+1}</a></li>`;
		}
		if(pager.pno+2<=pager.pageCount){
			pagerHtml+=`<li><a href="${pager.pno+2}">${pager.pno+2}</a></li>`;
		}
		$('.pager').html(pagerHtml);
	});
}
$(function(){
	$('#plist').on('click','.addcart',function(e){
		e.preventDefault();
		var pid=$(this).attr('href');
		$.post('data/1_cart_detail_add.php',{'pid':pid,'uname':loginName})
	})
});
$('#header').on('click','#settle_up',function(){
	location.href='shoppingcart.html?loginName='+loginName;
});

