<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additions</title>
</head>

<body
    style="margin:0; padding:0; height:100vh; display:flex; justify-content:center; align-items:center; background:linear-gradient(135deg,#d7e1ec,#fefcea); font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <div
        style="background:#ffffff; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.15); padding:30px 40px; width:350px; text-align:center;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
            <a href="/"
                style="text-decoration:none; color:white; background-color:lightseagreen; padding:6px 12px; border-radius:6px; font-size:14px; font-weight:600; box-shadow:0 2px 6px rgba(0,0,0,0.2); transition:0.3s;"
                onmouseover="this.style.backgroundColor='#20b2aa'; this.style.boxShadow='0 4px 10px rgba(32,178,170,0.4)';"
                onmouseout="this.style.backgroundColor='lightseagreen'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.2)';">
                ← Back
            </a>
            <h2 style="margin:0; color:#333; letter-spacing:1px;">➕ Additions</h2>
        </div>

        <form method="POST" action="{{ route('arithmetic.addition.calculate') }}" style="margin-top:25px;">
            @csrf

            <div style="text-align:left; margin-bottom:20px;">
                <label for="number1" style="display:block; font-weight:600; margin-bottom:5px; color:#444;">Number
                    1:</label>
                <input type="number" id="number1" name="number1" required
                    style="width:93%; padding:10px; border:1px solid #ccc; border-radius:8px; outline:none; transition:all 0.2s ease-in-out;"
                    onfocus="this.style.borderColor='lightseagreen';" onblur="this.style.borderColor='#ccc';">
            </div>

            <div style="text-align:left; margin-bottom:25px;">
                <label for="number2" style="display:block; font-weight:600; margin-bottom:5px; color:#444;">Number
                    2:</label>
                <input type="number" id="number2" name="number2" required
                    style="width:93%; padding:10px; border:1px solid #ccc; border-radius:8px; outline:none; transition:all 0.2s ease-in-out;"
                    onfocus="this.style.borderColor='lightseagreen';" onblur="this.style.borderColor='#ccc';">
            </div>

            <button type="submit"
                style="width:100%; border:none; border-radius:8px; background-color:lightseagreen; color:white; padding:12px 0; cursor:pointer; font-weight:bold; font-size:15px; transition:0.3s;"
                onmouseover="this.style.backgroundColor='#20b2aa'; this.style.boxShadow='0 4px 10px rgba(32,178,170,0.4)';"
                onmouseout="this.style.backgroundColor='lightseagreen'; this.style.boxShadow='none';">
                Calculate
            </button>
        </form>

        <hr style="margin:25px 0; border:0; border-top:1px solid #eee;">

        @if (isset($result))
            <h3 style="color:#222;">Result: <span style="color:lightseagreen;">{{ $result }}</span></h3>

            <button type="button"
                style="width:100%; border:none; border-radius:8px; background-color:#ff4d4d; color:white; padding:12px 0; cursor:pointer; font-weight:bold; font-size:15px; transition:0.3s;"
                onmouseover="this.style.backgroundColor='#b22222'; this.style.boxShadow='0 4px 10px rgba(178, 34, 34, 0.4)';"
                onmouseout="this.style.backgroundColor='#ff4d4d'; this.style.boxShadow='none';"
                onclick="window.location.href='{{ route('arithmetic.addition') }}'">
                Reset
            </button>
        @endif
    </div>

</body>

</html>