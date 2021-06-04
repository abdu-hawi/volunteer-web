<style>
    h1.cer{
        text-align: center;
        width: 100%;
        font-size: 60px;
        color: #0a3b54;
    }
    h1.certificate{
        text-align: center;
        width: 100%;
        font-size: 55px;
        color: #0a3b54;
    }
    h3.certificate{
        text-align: center;
        width: 100%;
        font-size: 30px;
        color: #73121e;
    }
    .qr{
        margin-left: 35%;
        width: 30%;
        text-align: center;
    }
</style>
<page backtop="10mm" >

    <h1 class="cer"> الفرصة التطوعية</h1>
    <h1 class="certificate">({!! $name !!})</h1>
    <br>
    <br>
    <qrcode value="abduV://{!! $id !!}" class="qr" style="border: none;"></qrcode>
    <br>
    <br>
    <h3 class="certificate">فضلا قم بالمسح على الباركود لتسجيل حضورك</h3>


</page>
