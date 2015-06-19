<script src="/WebDiP/2014_projekti/WebDiP2014x043/js/jquery-2.1.4.min.js"></script>
<script src="/WebDiP/2014_projekti/WebDiP2014x043/js/admin.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script>
    $(function () {
        $('#datepicker').datepicker({
            dateFormat: 'yy-dd-mm',
            onSelect: function (datetext) {
                var d = new Date(); // for now
                datetext = datetext + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
                $('#datepicker').val(datetext);
            }
        });
        $('#datepicker1').datepicker({
            dateFormat: 'yy-dd-mm',
            onSelect: function (datetext1) {
                var da = new Date(); // for now
                datetext1 = datetext1 + " " + da.getHours() + ":" + da.getMinutes() + ":" + da.getSeconds();
                $('#datepicker1').val(datetext1);
            }
        });

        $('#dnevnik').DataTable({
        });
        $('#sajmovi').DataTable({});


    });


</script>