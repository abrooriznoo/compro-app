<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn Laravel</title>
</head>

<body
    style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; margin: 0; padding: 0; background-color: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div
        style="background-color: #fff; padding: 40px 50px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center; width: 400px;">

        <div style="background-color: antiquewhite; padding: 15px; border-radius: 10px;">
            <h1 style="margin: 0; color: #333;">Matematika Sederhana</h1>
            <p style="margin: 5px 0 0; color: #555; font-size: 15px;">Pilih Menu Aritmatika di Bawah Ini:</p>
        </div>

        <div style="margin: 30px 0; display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">
            <a href="{{ route('arithmetic.addition') }}"
                style="display:inline-block; border-radius:8px; background-color: lightseagreen; padding: 12px 25px; text-decoration:none; color:white; font-weight:600; letter-spacing:0.5px; box-shadow:0 4px 8px rgba(0,0,0,0.15); transition:0.3s;"
                onmouseover="this.style.backgroundColor='#20b2aa'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 12px rgba(32,178,170,0.4)';"
                onmouseout="this.style.backgroundColor='lightseagreen'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)';">
                ➕ Addition
            </a>

            <a href="{{ route('arithmetic.subtraction') }}"
                style="display:inline-block; border-radius:8px; background-color: lightseagreen; padding: 12px 25px; text-decoration:none; color:white; font-weight:600; letter-spacing:0.5px; box-shadow:0 4px 8px rgba(0,0,0,0.15); transition:0.3s;"
                onmouseover="this.style.backgroundColor='#20b2aa'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 12px rgba(32,178,170,0.4)';"
                onmouseout="this.style.backgroundColor='lightseagreen'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)';">
                ➖ Subtraction
            </a>

            <a href="{{ route('arithmetic.division') }}"
                style="display:inline-block; border-radius:8px; background-color: lightseagreen; padding: 12px 25px; text-decoration:none; color:white; font-weight:600; letter-spacing:0.5px; box-shadow:0 4px 8px rgba(0,0,0,0.15); transition:0.3s;"
                onmouseover="this.style.backgroundColor='#20b2aa'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 12px rgba(32,178,170,0.4)';"
                onmouseout="this.style.backgroundColor='lightseagreen'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)';">
                ➗ Division
            </a>

            <a href="{{ route('arithmetic.multiplication') }}"
                style="display:inline-block; border-radius:8px; background-color: lightseagreen; padding: 12px 25px; text-decoration:none; color:white; font-weight:600; letter-spacing:0.5px; box-shadow:0 4px 8px rgba(0,0,0,0.15); transition:0.3s;"
                onmouseover="this.style.backgroundColor='#20b2aa'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 12px rgba(32,178,170,0.4)';"
                onmouseout="this.style.backgroundColor='lightseagreen'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)';">
                ✖️ Multiplication
            </a>
        </div>

        <hr style="border: 0; border-top: 1px solid #ddd; margin: 10px 0 0;">

        <p style="font-size: 13px; color: #999; margin-top: 10px;">Belajar Laravel & Aritmatika © Abroorizno 2025</p>
    </div>

</body>

</html>