
<style>

    *{
        font-family: 'Cairo-Regular ', serif;
    }
    table{
        width: 100%;
    }
    table.header{
        /*border: 1px #000000 solid;  background: #cccccc*/
    }
    h1.title{
        /*text-align: center;*/
        width: 100%;
    }
    h1.certificate{
        text-align: center;
        width: 100%;
        font-size: 60px;
        color: #0a3b54;
    }
    h1.title{
        font-size: 40px;
        padding: 0;
        margin: 0;
    }
    td.a-header{
        width: 100%;
        text-align: center;
        font-size: 30px;
    }
    td.a-name{
        width: 100%;
        text-align: center;
        font-size: 40px;
    }
    td.a-company{
        width: 100%;
        text-align: center;
        font-size: 60px;
    }
</style>

<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
    <page_header>
        <table class="header">
            <tr>
                <td style="width: 25%; text-align: left; padding: 0; margin: 0"><h1 class="title">
                        <img src="http://127.0.0.1/volunteer/2030.png" width="120" alt="a">
                    </h1></td>
                <td style="width: 50%; text-align: center"></td>
                <td style="width: 25%; text-align: right; padding: 0; margin: 0"><h1 class="title">
                        <img src="http://127.0.0.1/volunteer/logo-d-dec-small.png" width="120" alt="a">
                    </h1></td>
            </tr>
        </table>
    </page_header>
    <h1 class="certificate">
        شهادة تطوع عامة
    </h1>
<br><br>
    <table>
        <tr>
            <td class="a-header">تشهد منصة العمل التطوعي بأن</td>
        </tr>
        <tr><td class="a-header"></td></tr>
        <tr><td class="a-header"></td></tr>
        <tr><td class="a-header"></td></tr>
        <tr>
            <td class="a-name">{!! $name !!}</td>
        </tr>
        <tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr>
        <tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr>
        <tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr>
        <tr>
            <td class="a-header">قد ساهم في تحقيق مستهدف رؤية المملكة 2030 ({!! $namIni !!}) من خلال تنفيذه لعدد ({!! $hours !!}) ساعات تطوعية لدى</td>
        </tr>
        <tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr>
        <tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr>
        <tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr>
        <tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr>
        <tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr>
        <tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr><tr><td class="a-header"></td></tr>
        <tr>
            <td class="a-company">جمعية الذكاء الاصطناعي</td>
        </tr>
    </table>


    <page_footer>
        <table>
            <tr>
                <td style="width: 100%; text-align: center">
                    حررت في 2020-12-05
                </td>
            </tr>
        </table>
    </page_footer>

</page>
