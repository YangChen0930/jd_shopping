
$(function(){
	$('#header').load('header.php',function(){
		$('#welcome').html('欢迎回来：'+loginName);
	});
	$('#footer').load('footer.php');
});
var s=location.search;
var i=s.indexOf('=');
var loginName=s.slice(i+1);

$(function(){
	$.getJSON('data/1_cart_detail_select.php',{'uname':loginName},function(list){
		var html='';
		$.each(list,function(i,product){
			html+=`
			<tr>
        <td>
          <input type="checkbox"/> 
          <input type="hidden" value="${product.did}" /> 
          <div><img src="${product.pic}" alt=""/></div>
        </td>
        <td><a href="">${product.pname}</a></td>
        <td>${product.price}</td>
        <td>
          <button>-</button><input type="text" value="${product.count}"/><button>+</button>
        </td>
        <td><span>${product.price}</span></td>
        <td><a href="${product.did}">删除</a></td>
      </tr>	
		`;
		});
		$('#cart>tbody').html(html);
	})
});
$('#cart>tbody').on('click','button',function(){
		//var did=product.did;
		var m=$(this).html();
		if(m==="-"){
			var count=$(this).next('input').val();
			count>1&&(count--);
			return $(this).next('input').val(count);
		}
		if(m==="+"){
			var count=$(this).prev('input').val();
			count++;
			return $(this).prev('input').val(count);
		}
		$.post('data/1_cart_update.php',{'did':did,'count':count});
});