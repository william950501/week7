<?php
function isFreeRole(string $role): bool {
    return in_array($role, ['T', 'M']);
}
function getRoleName(string $role): string {
    return match ($role) {
        'T' => '老師',
        'S' => '學生',
        'M' => '管理員',
    };
}
?>
