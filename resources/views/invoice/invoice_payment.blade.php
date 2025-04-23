<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Steps</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f7fa;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 450px;
      margin: 80px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.05);
      overflow: hidden;
    }
    .step {
      display: none;
      padding: 25px 20px;
    }
    .step.active {
      display: block;
    }
    .payment-method {
      border: 2px solid #ddd;
      padding: 15px;
      margin-bottom: 12px;
      cursor: pointer;
      border-radius: 8px;
      font-weight: 500;
      transition: 0.3s;
    }
    .payment-method:hover {
      border-color: #007bff;
    }
    .payment-method.selected {
      border-color: #007bff;
      background-color: #e6f0ff;
    }
    .btn {
      width: 100%;
      padding: 14px;
      margin-top: 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
    }
    .btn.back {
      background-color: #6c757d;
    }
    input[type="text"] {
      width: 100%;
      padding: 12px;
      margin-top: 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 15px;
    }
    .summary {
      background: #eef3f8;
      border-left: 4px solid #007bff;
      padding: 15px 20px;
      border-radius: 8px;
      margin-top: 20px;
    }
    .summary .summary-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 16px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }
    .summary .contact {
      font-size: 14px;
      color: #555;
      margin-top: 10px;
      line-height: 1.6;
    }
    .instruction {
      background: #fcfcfc;
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 8px;
      margin-top: 18px;
    }
    .instruction h4 {
      margin-bottom: 10px;
      color: #007bff;
      font-size: 17px;
    }
    .instruction p {
      margin: 6px 0;
      font-size: 14px;
      line-height: 1.6;
    }
    .top-back-btn {
      position: fixed;
      top: 10px;
      left: 10px;
      z-index: 999;
      display: none;
    }
    .top-back-btn button {
      background-color: #6c757d;
      color: white;
      border: none;
      padding: 10px 15px;
      font-size: 14px;
      border-radius: 6px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<!-- Top Back Button -->
<div class="top-back-btn" id="backBtn">
  <button onclick="goToStep(1)">← Back</button>
</div>

<div class="container">
  <!-- Step 1 -->
  <div class="step active" id="step1">
    <h3>Select Payment Method</h3>
    @foreach ($banks as $bank)
      <div class="payment-method" onclick="selectMethod(this, '{{ $bank->name }}')">{{ $bank->name }}</div>
    @endforeach

    <div class="summary">
      <div class="summary-row">
        <span>📞 Mobile</span>
        <span>01796351081</span>
      </div>
      <div class="summary-row">
        <span>💰 Payable Amount</span>
        <span>৳134</span>
      </div>
      <div class="contact">
        ℹ️ If you need any help, contact us: <strong>01796351081</strong>
      </div>
    </div>

    <button class="btn" onclick="goToStep(2)">Continue</button>
  </div>

  <!-- Step 2 -->
  <div class="step" id="step2">
    <h3>Enter Sender Number / Reference</h3>
    <input type="text" id="paymentInput" placeholder="Enter Number or Reference" value="01796351081" />

    <div class="instruction" id="instructionBox">
      <h4>How to Pay (bKash)</h4>
      <p>1. Go to your <span id="methodLabel">bKash</span> App or Dial *247#</p>
      <p>2. Select: Send Money</p>
      <p>3. Receiver Number: <strong>01796351081</strong></p>
      <p>4. Amount: <strong>৳134</strong></p>
      <p>5. Reference: <strong>Your Mobile Number</strong></p>
      <p>6. After payment, enter the sender number or reference above and confirm.</p>
    </div>

    <div class="summary">
      <div class="summary-row">
        <span>📞 Mobile</span>
        <span>01796351081</span>
      </div>
      <div class="summary-row">
        <span>💰 Payable Amount</span>
        <span>৳134</span>
      </div>
      <div class="contact">
        ℹ️ If you need any help, contact us: <strong>01796351081</strong>
      </div>
    </div>

    <button class="btn" onclick="alert('✅ Payment Confirmed')">Confirm</button>
  </div>
</div>

<script>
  let selectedMethod = '';

  function selectMethod(el, method) {
    selectedMethod = method;
    document.querySelectorAll('.payment-method').forEach(div => div.classList.remove('selected'));
    el.classList.add('selected');
  }

  function goToStep(step) {
    const steps = document.querySelectorAll('.step');
    steps.forEach(s => s.classList.remove('active'));
    document.getElementById('step' + step).classList.add('active');

    document.getElementById('backBtn').style.display = step === 2 ? 'block' : 'none';

    if (step === 2) {
      if (!selectedMethod) {
        alert('Please select a payment method first.');
        goToStep(1);
        return;
      }

      const input = document.getElementById('paymentInput');
      const instructionBox = document.getElementById('instructionBox');
      const methodLabel = document.getElementById('methodLabel');

      input.placeholder = selectedMethod === 'Bank' ? 'Enter Transaction Reference' : `Enter ${selectedMethod} Number`;
      methodLabel.innerText = selectedMethod;

      let instructionHTML = `<h4>How to Pay (${selectedMethod})</h4>`;

      if (selectedMethod === 'Bank') {
        instructionHTML += `
          <p>1. Go to your mobile banking app or visit your nearest bank.</p>
          <p>2. Select "Send Money" or "Bank Transfer".</p>
          <p>3. Bank Name: <strong>${selectedMethod}</strong></p>
          <p>4. Account Name: <strong>Shahazzo Software Solution</strong></p>
          <p>5. Account Number: <strong>1234567890123</strong></p>
          <p>6. Amount: <strong>৳134</strong></p>
          <p>7. Reference: <strong>Your Mobile Number</strong></p>
          <p>8. After transfer, enter reference or sender number above and confirm.</p>`;
      } else {
        instructionHTML += `
          <p>1. Open your ${selectedMethod} app or dial its USSD code.</p>
          <p>2. Choose: Send Money</p>
          <p>3. Receiver Number: <strong>01796351081</strong></p>
          <p>4. Amount: <strong>৳134</strong></p>
          <p>5. Reference: <strong>Your Mobile Number</strong></p>
          <p>6. After payment, enter sender number above & confirm.</p>`;
      }

      instructionBox.innerHTML = instructionHTML;
    }
  }
</script>

</body>
</html>
