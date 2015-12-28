 <!-- Main jumbotron for a primary marketing message or call to action -->
 

 <div class="container" style="min-height:600px">
  <div class="col-lg-3">
      
    <h3>Event</h3>
    <hr>
    全館限時 宅配599免運/ 超取799免運
    任選兩雙超值組$750
    親子鞋 任選2雙85折
    小資職場穿搭術 $299
    零碼回饋 均一價$299
    X'mas 配件專區3件85折
    服飾本周新品79折
    內衣褲/睡衣 "限時折扣" 中
    卡通小物新品85折
    部落客推薦區
    服飾5折現貨專區
    服飾秋冬現貨專區
    X'mas 交換禮物
   
</div>
<div class="col-lg-9">
   
        <h3>Orders History </h3>
        
        <hr>
        
        <table id="tableData" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <?php  echo $histories ?>
        </tbody>
    </table>

    
</div>


<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="delete_confirm"></h4>
    </div>
    <div class="modal-body" >
        Are you sure to delete this <?php echo $type ?> ? 
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a id="delete_submit" id-item="" class="btn btn-danger">Delete</a>
    </div>
</div>
</div>
</div>

</div>
<!-- Example row of columns -->




</div> <!-- /container -->
<footer>
      <div class="container">
        <div class="row">
          <div class="col-xs-7">
            <h3 class="footer-title">Subscribe</h3>
            <p>Do you like this freebie? Want to get more stuff like this?<br>
              Subscribe to designmodo news and updates to stay tuned on great products.<br>
              Go to: <a href="http://designmodo.com/flat-free" target="_blank">Anybaba.com</a>
            </p>

            <p class="pvl">
              <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" class="twitter-share-button twitter-share-button-rendered twitter-tweet-button" title="Twitter Tweet Button" src="http://platform.twitter.com/widgets/tweet_button.c633b87376883931e7436b93bb46a699.en.html#_=1451026366345&amp;dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fdesignmodo.github.io%2FFlat-UI%2F&amp;size=m&amp;text=Flat%20UI%20Free%20-%20PSD%26amp%3BHTML%20User%20Interface%20Kit&amp;type=share&amp;url=http%3A%2F%2Fdesignmodo.com%2Fflat-free%2F&amp;via=designmodo" style="position: static; visibility: visible; width: 61px; height: 20px;" data-url="http://designmodo.com/flat-free/"></iframe>
                            <script id="twitter-wjs" src="http://platform.twitter.com/widgets.js"></script><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
              <iframe src="http://ghbtns.com/github-btn.html?user=designmodo&amp;repo=Flat-UI&amp;type=watch&amp;count=true" height="20" width="107" frameborder="0" scrolling="0" style="width:105px; height: 20px;" allowtransparency="true"></iframe>
              <iframe src="http://ghbtns.com/github-btn.html?user=designmodo&amp;repo=Flat-UI&amp;type=fork&amp;count=true" height="20" width="107" frameborder="0" scrolling="0" style="width:105px; height: 20px;" allowtransparency="true"></iframe>
             
            </p>

           
          </div> <!-- /col-xs-7 -->

          <div class="col-xs-5">
            <div class="footer-banner">
              <h3 class="footer-title">Get Summer Discount</h3>
              <ul>
                <li>Tons of Clothes and Swimsuit</li>
                <li>A Lot of Discount up to 90 %</li>
                <li>More options Colour and Model</li>
                <li>Gold  Membership</li>
              
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>



        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive" src="">
                    </div>
                    <div class="modal-footer">

                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" id="show-previous-image">Previous</button>
                        </div>

                        <div class="col-md-8 text-justify" id="image-gallery-caption">
                            This text will be overwritten by jQuery
                        </div>

                        <div class="col-md-2">
                            <button type="button" id="show-next-image" class="btn btn-default">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>