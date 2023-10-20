<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Mail Queue</title>
</head>

<body>
    <section style="max-width: 2xl; padding: 24px 48px; margin: 0 auto; background-color: #ffffff; dark:bg-gray-900;">
        <main style="margin-top: 24px;">
            <h2 style="color: #374151; font-size: 20px;">{{ ucfirst($name) }}</h2>

            <p style="margin-top: 10px; font-size: 14px; line-height: 1.5; color: #4B5563; dark:text-gray-300;">
                {{ ucfirst($content) }}
            </p>

            <a href="{{ $url }}"
                style="padding: 6px 12px; margin-top: 20px; font-size: 14px; font-weight: 500; text-decoration: none; letter-spacing: 1px; text-transform: capitalize; background-color: #2563EB; border: none; border-radius: 8px; color: white; transition: background-color 0.3s, transform 0.3s; outline: none; outline-offset: -2px; box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5); cursor: pointer;">
                確認する
            </a>
        </main>

        <footer style="margin-top: 8px">
            <p style="margin-top: 20px; font-size: 12px; line-height: 1.5; color: #9CA3AF; dark:text-gray-400;">©
                ExamMedico. All Rights Reserved.</p>
        </footer>
    </section>
</body>

</html>
