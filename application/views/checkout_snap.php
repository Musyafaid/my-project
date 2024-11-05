<html>
<title>Checkout</title>
  <head>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<CLIENT-KEY>"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  </head>
  <body>

    <form id="payment-form" method="post" action="<?=site_url()?>">
      <input type="hidden" name="result_type" id="result-type" value="">
      <input type="hidden" name="result_data" id="result-data" value="">
    </form>
    
    <script type="text/javascript">
  
    $(document).ready(function () {
      var snapToken = '<?= $snapToken ?>'; 

      console.log('token = ' + snapToken);
      
      var resultType = document.getElementById('result-type');
      var resultData = document.getElementById('result-data');

      function changeResult(type, data) {
        $("#result-type").val(type);
        $("#result-data").val(JSON.stringify(data));
      }

      snap.pay(snapToken, {
        onSuccess: function(result) {
          changeResult('success', result);
          console.log(result.status_message);
          $("#payment-form").submit();
        },
        onPending: function(result) {
          changeResult('pending', result);
          console.log(result.status_message);
          $("#payment-form").submit();
        },
        onError: function(result) {
          changeResult('error', result);
          console.log(result.status_message);
          $("#payment-form").submit();
        }
      });
    });

    </script>
</body>
</html>
