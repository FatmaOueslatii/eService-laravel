<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f3f3f3; }
        h2 { text-align: center; }
    </style>
</head>
<body>
<h2>Liste des utilisateurs</h2>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Date de création</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $i => $user)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->format('d/m/Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
