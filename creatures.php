<?php
// creatures.php
require_once 'includes/config.php';
include 'includes/header.php';

try {
    $stmt = $pdo->query("SELECT id, name, type, habitat FROM creatures ORDER BY name");
    $creatures = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Ошибка при получении списка существ: " . $e->getMessage());
}
?>

<h2>Каталог существ (Ёкаи и Юреи)</h2>
<p>Всего записей: <?php echo count($creatures); ?></p>

<div class="catalog-grid">
    <?php foreach ($creatures as $creature): ?>
        <div class="card">
            <h3><a href="creature.php?id=<?php echo $creature['id']; ?>"><?php echo htmlspecialchars($creature['name']); ?></a></h3>
            <p><strong>Тип:</strong> <?php echo htmlspecialchars($creature['type']); ?></p>
            <p><strong>Обитание:</strong> <?php echo htmlspecialchars($creature['habitat']); ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'includes/footer.php';
?>