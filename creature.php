<?php
// creature.php
require_once 'includes/config.php';

// Проверяем, передан ли ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: creatures.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    // данные о существе
    $stmt = $pdo->prepare("SELECT * FROM creatures WHERE id = ?");
    $stmt->execute([$id]);
    $creature = $stmt->fetch();

    if (!$creature) {
        header('Location: creatures.php');
        exit;
    }

    // Получаем историю, если есть story_id
    $story = null;
    if (!empty($creature['story_id'])) {
        $stmtStory = $pdo->prepare("SELECT name, story FROM story WHERE id = ?");
        $stmtStory->execute([$creature['story_id']]);
        $story = $stmtStory->fetch();
    }

    // Получаем место, если есть place_id
    $place = null;
    if (!empty($creature['place_id']) && $creature['place_id'] !== '-') {
        $stmtPlace = $pdo->prepare("SELECT place_name, `desc`, geo, climate FROM place WHERE id = ?");
        $stmtPlace->execute([$creature['place_id']]);
        $place = $stmtPlace->fetch();
    }

} catch (PDOException $e) {
    die("Ошибка при получении данных: " . $e->getMessage());
}

include 'includes/header.php';
?>

<h2><?php echo htmlspecialchars($creature['name']); ?></h2>
<?php if (!empty($creature['name_kanji'])): ?>
    <p style="font-size: 2rem;"><?php echo htmlspecialchars($creature['name_kanji']); ?></p>
<?php endif; ?>

<div class="detail-block">
    <h3>Описание</h3>
    <p><?php echo nl2br(htmlspecialchars($creature['desc'])); ?></p>
</div>

<table class="info-table">
    <tr>
        <th>Тип:</th>
        <td><?php echo htmlspecialchars($creature['type']); ?></td>
    </tr>
    <tr>
        <th>Среда обитания:</th>
        <td><?php echo htmlspecialchars($creature['habitat']); ?></td>
    </tr>
</table>

<?php if ($story): ?>
    <hr>
    <div class="detail-block">
        <h3>Легенда: <?php echo htmlspecialchars($story['name']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($story['story'])); ?></p>
    </div>
<?php endif; ?>

<?php if ($place): ?>
    <hr>
    <div class="detail-block">
        <h3>Священное место: <?php echo htmlspecialchars($place['place_name']); ?></h3>
        <p><strong>Описание места:</strong> <?php echo nl2br(htmlspecialchars($place['desc'])); ?></p>
        <p><strong>География:</strong> <?php echo nl2br(htmlspecialchars($place['geo'])); ?></p>
        <p><strong>Климат:</strong> <?php echo nl2br(htmlspecialchars($place['climate'])); ?></p>
    </div>
<?php endif; ?>

<p><a href="creatures.php">← Вернуться к каталогу существ</a></p>

<?php
include 'includes/footer.php';
?>