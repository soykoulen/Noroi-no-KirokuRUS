<?php
// deities.php
require_once 'includes/config.php';
include 'includes/header.php';

try {
    $stmt = $pdo->query("SELECT id, kami, domain FROM deity ORDER BY kami");
    $deities = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Ошибка при получении списка божеств: " . $e->getMessage());
}
?>

<h2>Каталог божеств (Ками)</h2>
<p>Всего записей: <?php echo count($deities); ?></p>

<div class="catalog-grid">
    <?php foreach ($deities as $deity): ?>
        <div class="card">
            <h3><a href="deity.php?id=<?php echo $deity['id']; ?>"><?php echo htmlspecialchars($deity['kami']); ?></a></h3>
            <p><strong>Сфера влияния:</strong> <?php echo htmlspecialchars($deity['domain']); ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'includes/footer.php';
?>