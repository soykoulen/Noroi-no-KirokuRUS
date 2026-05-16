<?php
// deity.php
require_once 'includes/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: deities.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM deity WHERE id = ?");
    $stmt->execute([$id]);
    $deity = $stmt->fetch();

    if (!$deity) {
        header('Location: deities.php');
        exit;
    }

    // Получаем историю ками
    $story = null;
    if (!empty($deity['story_id'])) {
        $stmtStory = $pdo->prepare("SELECT story_name, story FROM story_deity WHERE id = ?");
        $stmtStory->execute([$deity['story_id']]);
        $story = $stmtStory->fetch();
    }

} catch (PDOException $e) {
    die("Ошибка: " . $e->getMessage());
}

include 'includes/header.php';
?>

<h2><?php echo htmlspecialchars($deity['kami']); ?></h2>
<?php if (!empty($deity['name_kanji'])): ?>
    <p style="font-size: 2rem;"><?php echo htmlspecialchars($deity['name_kanji']); ?></p>
<?php endif; ?>

<div class="detail-block">
    <h3>Описание</h3>
    <p><?php echo nl2br(htmlspecialchars($deity['desc'])); ?></p>
</div>

<table class="info-table">
    <tr>
        <th>Сфера влияния:</th>
        <td><?php echo htmlspecialchars($deity['domain']); ?></td>
    </tr>
</table>

<?php if ($story): ?>
    <hr>
    <div class="detail-block">
        <h3>Миф: <?php echo htmlspecialchars($story['story_name']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($story['story'])); ?></p>
    </div>
<?php endif; ?>

<p><a href="deities.php">← Вернуться к каталогу божеств</a></p>

<?php
include 'includes/footer.php';
?>