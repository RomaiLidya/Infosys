<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
      .table{
            border:1px solid #02A9EA;
            background-color: #f0f4fc;
            width: 210px !important;
            height: 150px !important;
        }
      .emptyTable{ 
            width: 210px !important;
            height:150px !important;
            }
      .companyImg  {
            width : 36%;
            height: auto;
            
            }    
        
      .ridge{
            border:17px;
            background-color: #02A9EA;
            color: #ffffff;
            height:10%;
            font-size: 15px;
            margin-top: 9px;
            padding-top:9px;
            margin-left:10px;
            padding-left:10px;
            } 
      .textCat{
            color: #ffffff;
            font-size: 26px;
            } 
      .imgHeader {
            padding-left: -15%;
            margin-left: -15%;
            width: 220%;
            height: auto;
        } 
        .imgHead{
            width: 20%;
            height: auto;
        }
        .divImageItem {
            height: 120px !important;
            width: 210px !important;
        }
        .divItem {
            margin: 0 auto;
            display: block;
            text-align: center;
        }
        .imgItem {
            height: 120px;
            width: auto;
            max-width: 210px;
            margin-right: -2px;
            font-family: 'Roboto';
        } 
       .right{
        padding-left: 57px;
        margin-left:57px;
        } 
     
        .rightPict {
           float: right;
           padding-bottom:-3%;
           margin-bottom:-3%;
           } 
       .titleHeader {
           color: #02A9EA;
           font-family: 'Roboto';
           }
       .centerText{
            text-align: center;
            padding-top:1%;
            margin-top:1%;
            max-height: 120px;
   
       }
       .titleHead {
            padding-top:2%;
            margin-top:2%;
            color: #02A9EA;
            padding-left:1.5%;
            margin-left:1.5%;
            text-transform: uppercase;
       }
       .pCode {
            padding-left:1.5%;
            margin-left: 1.5%;
         
       }
        .hr {
            margin-top: -180px;
            padding-top: -180px;
            color: #02A9EA;
           }
        .hrOne {
            color: #02A9EA;
           }
           .companyImgLg  {
          
            height: 75px;
            width: auto;
         
            } 
        .companyImageSecond  {
            width: 85px;
            height: auto;
            padding-left: 61px;
            margin-left:61px;
            margin-top: 10px;
            padding-top: 10px;
            } 
        .main {
           padding-top:-100px;
           margin-top:-100px;
           font-size: 117px;
            color: #02A9EA;
            font-family: 'Roboto';        
           }
        .second {
            padding-top:-200px;
            margin-top:-200px;      
            font-size: 97px;
            color:  #464646;
            font-family: 'Roboto'; 
          
                }
        
        * {
        box-sizing: border-box;
        
        }
       

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: 300px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        .columnHeader {
        float: left;
        color: #ffffff;
        width:215px;
        padding: 10px;
        height: 100px; /* Should be removed. Only for demonstration */
        }
        
        .leftcolumn {
            float: left;
            width: 75%;
        }
        .card {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
        }

        .page-break {
            page-break-after: always;
        }

        .page-break:last-child {
            page-break-after: avoid !important;
        }
</style>
</head>
<body>
    
    <div class="row">
    <div class="column" >
        <img src="{{ public_path('images/' . $company->image)}}" alt="Company" class="companyImg">        
    </div>
    <div class="column">
        <p  class="right" ><b>CENTRAL CAHAYA ABADI</b>
        <br>
        <span class="titleHeader">No Telp : 0822-8491-2014</span>
        </p>
    </div>
    </div>

    <hr class="hr"> 

    <table>
         <td class="main"> 
    <p><b>Katalog</b></p>
        </td>
    </table>

    <table>
        <td class="second"> 
            <p>Produk</p>
         <td> 
    </table>

    <div class="row">
        <div class="column" >
           <img src="{{ public_path('/static/media/Capture.JPG') }}" >  
        </div>
        <div class="column">
           <img src="{{public_path('/static/media/sample.png') }}" class="imgHeader">
        </div>
    </div>

    <div class="page-break"></div>
        @php($count = 0)
        @foreach($products as $cat => $item)
                @php($count++)
                <div class="row">
                <div class="columnHeader" style="background-color:#02A9EA;">
                    <p><b> &nbsp; &nbsp;Kategori</b><p>
                    <p style="font-size:18px; text-transform: uppercase;"><b> &nbsp; {{$cat}}<b></p>
                </div>
                <div class="columnHeader" style="background-color:#02A9EA;">
                
                </div>
                <div class="columnHeader" style="background-color:#02A9EA;">  
                <img src="{{ public_path('/static/media/CCA_logo_wht.png') }}"  class="companyImageSecond">
                </div>
                </div>
     
            <?php
             $totalLoop = ceil(count($item)/3);
             $totalCol = 0;
            ?>

            <!-- item -->
            <table cellSpacing="13px" width="100%" height="100%">

                <tbody>
                @for($i=0; $i < $totalLoop; $i++)
                    <tr>
                    <?php 
                        $tmp = $totalCol  + 3;
                        while( $totalCol < $tmp): 
                    ?>

                    <?php if(isset($item[$totalCol])): ?>
                        <td class="table" >
                            <div class="divImageItem">
                                @if($item[$totalCol]['productImage'])
                                    <div class="divItem">
                                        <img src="{{ $item[$totalCol]['productImage']}}" class="imgItem">
                                    </div>
                                @else
                                    <p class="centerText" style="font-size:18px"; ><b>{{ ucwords($item[$totalCol]['productName']) }}</b>
                                   <br>
                                   <br>
                                   <img src="{{public_path('/static/media/CCA_logo_new.png') }}" class="companyImgLg">
                                   </p>
                              
                                    @endif
                            </div>
                            
                            <span>                               
                                <p class="titleHead"  style="font-size:15px"><b><?= ucwords($item[$totalCol]['productName']) ?></b></p>
                                <hr class="hrOne"/>
                                <p class="pCode"  style="font-size:15px">Kode:<?= $item[$totalCol]['productCode'] ?></p>
                            </span>
                        </td>
                    <?php else : ?>
                        <td class="emptyTable">
                            <div class="divImageItem">&nbsp;</div>
                        </td>   
                    <?php endif;?>
                    <?php $totalCol++ ?>
                    <?php endwhile ?>
                   
                </tr>
                
                @endfor
                </tbody>    
            </table>
            @if ($count < count($products))
            <div class="page-break"></div>
            @endif
        @endforeach
       
    <footer>
        
    <script type="text/php">
        if (isset($pdf)) {
            $x = 250;
            $y = 10;
            $text = "{PAGE_NUM}";
            $font = null;
            $size = 14;
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text(550, 800, $text, $font, $size, $word_space, $char_space, $angle);
            $pdf->page_text(30, 800, "CENTRAL CAHAYA ABADI - Telp : 0761 8048264", $font, $size,  $word_space, $char_space, $angle);
        }
    

    </script>
  
    </footer>
   

    </body>
</html>