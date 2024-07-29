
<?php 
    function loadModalScanPackage(){
    echo '
      <div class="modal fade" id="modalInScanPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelFake">In Thông Tin Lô</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body modal-body-in">
                <iframe id="myFramed" name="framede" class="embed-responsive-item" src="" allowfullscreen width="auto" height="auto"></iframe>

            </div>
            <div class="modal-footer">    
              <button type="button" id="btnBillFake" onclick="frames[\'framede\'].print()" class="btn btn-secondary" data-dismiss="modal">In Bill</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    ';
  }

  function loadModalInShippingMark(){
    echo '
      <div class="modal fade" id="modalInShippingmark" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelFake">In Shipping Mark</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <iframe id="myFramedsm" name="framedsm" class="embed-responsive-item" src="" allowfullscreen width="auto" height="auto"></iframe>

            </div>
            <div class="modal-footer">    
              <button type="button" id="btnBillFake" onclick="frames[\'framedsm\'].print()" class="btn btn-secondary" data-dismiss="modal">In Bill</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
	  
	  
	  
	  
    ';
  }
  function loadModalInShippingMarks(){
    echo '
      <div class="modal fade" id="modalInShippingmarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelFakes">In Shipping Mark</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body modal-body-in">
                <iframe id="myFramedsms" name="framedsms" class="embed-responsive-item" src="" allowfullscreen width="auto" height="auto"></iframe>

            </div>
            <div class="modal-footer">    
              <button type="button" id="btnBillFake" onclick="frames[\'framedsms\'].print()" class="btn btn-secondary" data-dismiss="modal">In Bill</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    ';
  }  
  
    function loadModalInShippingMark_kor(){
    echo '
      <div class="modal fade" id="modalInShippingmark" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelFake">In Shipping Mark</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body modal-body-in">
                <iframe id="myFramedsm" name="framedsm" class="embed-responsive-item" src="" allowfullscreen width="auto" height="auto"></iframe>

            </div>
            <div class="modal-footer">    
              <button type="button" id="btnBillFake" onclick="frames[\'framedsm\'].print()" class="btn btn-secondary" data-dismiss="modal">In Bill</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    ';
  }
  function loadModalInShippingMarks_kor(){
    echo '
      <div class="modal fade" id="modalInShippingmarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelFakes">In Shipping Mark</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body modal-body-in">
                <iframe id="myFramedsms" name="framedsms" class="embed-responsive-item" src="" allowfullscreen width="auto" height="auto"></iframe>

            </div>
            <div class="modal-footer">    
              <button type="button" id="btnBillFake" onclick="frames[\'framedsms\'].print()" class="btn btn-secondary" data-dismiss="modal">In Bill</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    ';
  }

  function loadModalInBillPayment(){
    echo '
      <div class="modal fade" id="modalInBillPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelFake">In phiếu thanh toán</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body modal-body-in">
                <iframe id="myFramedpay" name="framedpay" class="embed-responsive-item" src="" allowfullscreen width="auto" height="auto"></iframe>

            </div>
            <div class="modal-footer">    
              <button type="button" id="btnBillFake" onclick="frames[\'framedpay\'].print()" class="btn btn-secondary" data-dismiss="modal">In Bill</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    ';
  }

  function loadImageModal(){
    echo '<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" width="100%">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Cập nhật hình ảnh</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body modal-body-in">
              <iframe style="background-color: Snow;" id="myFrameimage" name="framed" class="embed-responsive-item" src="" allowfullscreen width="auto" height="auto"></iframe>

          </div>
          <div class="modal-footer">    

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>';
  }
?>