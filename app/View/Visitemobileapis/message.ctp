<style>
    .content-wrapper
    {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color:white;
    }
    .content-header{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .mes{
        font-size:30px;
        font-weight:800;
        text-align:center;
        font-family:"Ralewy";
        margin-top: 20px!important;
    }
    .back{
        background: white;
        box-shadow: rgb(149 157 165 / 20%) 0px 8px 24px;
        width: 100%;
        text-align: center;
        margin: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 6px;
        border-radius: 11px;
    }
</style>
<?php $img="";
if($etat=="ok")
$img="ok.png";
else
$img="error.png";
echo $this->Html->image($img);?>
<h1 class="mes"><?php 
echo $message; 
?></h1>
<a onclick="post()" class="back"><i data-feather="arrow-left"></i></a>
<script src="https://unpkg.com/feather-icons" ></script>
<script>
    feather.replace();
    window.ReactNativeWebView.postMessage('<?php echo $etat?>')
    function post(){
        window.ReactNativeWebView.postMessage('back-<?php echo $etat?>')
    }
</script>