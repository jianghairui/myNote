 <!DOCTYPE html>
 <html>
 <head>
     <title></title>
     <style type="text/css">
        html,body,#module_list{
            width:100%;height:100%;
        }
        .modules{
            width:100%;height:100px;background:grey;
        }
     </style>
 </head>
 <body>
    
    <div id="module_list">  

        <?php for ($i = 0; $i < 6; $i++) { ?>  

            <div class="modules" title="<?php echo $i; ?>">  
            <h3 class="m_title">Module: <?php echo $i; ?></h3>  
            <p> <?php echo $i; ?></p>  
            </div>  

        <?php } ?>  
         
    </div>
 </body>
 </html>
 <script type="text/javascript" src="jquery.js"></script>
 <script type="text/javascript" src="jquery-ui.min.js"></script>
 <script type="text/javascript">

    // $(function(){
    //     alert('OK');
    // })
    $(".m_title").bind('mouseover', 
    function() { 
        $(this).css("cursor", "move") 
    }); 
 
    var $show = $("#loader"); //进度条 
    var $orderlist = $("#orderlist"); 
    var $list = $("#module_list"); 
 
    $list.sortable({ 
        opacity: 0.6, 
        revert: true, 
        cursor: 'move', 
        handle: '.m_title', 
        update: function() { 
            var new_order = []; 
            $list.children(".modules").each(function() { 
                new_order.push(this.title); 
            }); 
            var newid = new_order.join(','); 
            var oldid = $orderlist.val();
            alert(newid); 
            // $.ajax({ 
            //     type: "post", 
            //     url: "update.php", 
            //     data: { 
            //         id: newid, 
            //         order: oldid 
            //     }, 
            //     //id:新的排列对应的ID,order：原排列顺序 
            //     beforeSend: function() { 
            //         $show.html("<img src='images/load.gif' /> 正在更新"); 
            //     }, 
            //     success: function(msg) { 
            //         $show.html(""); 
            //     } 
            // }); 
        } 
    }); 

 </script>