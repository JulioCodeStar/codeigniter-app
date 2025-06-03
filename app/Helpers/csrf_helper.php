<?php
// app/Helpers/csrf_helper.php

if (!function_exists('csrf_scripts_basic')) {
    function csrf_scripts_basic(): string
    {
        // Obtener base_url desde CodeIgniter
        $base_url = base_url();
        
        return <<<EOD
        <script>
            const BASE_URL = '{$base_url}';

            // Obtener token actual
            function getCsrfToken() {
                const metaTag = document.querySelector('meta[name="csrf-token"]');
                return metaTag ? metaTag.content : '';
            }

            // Actualizar token desde el servidor
            async function updateCsrfToken() {
                try {
                    const response = await fetch(BASE_URL + 'api/csrf/refresh-token', {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': getCsrfToken()
                        }
                    });
                    
                    if (!response.ok) throw new Error('Error actualizando token (' + response.status + ')');
                    
                    const data = await response.json();
                    document.querySelector('input[name="csrf_test_name"]').value = data.csrf_token;
                    return data.csrf_token;
                    
                } catch (error) {
                    console.error('Error CSRF:', error);
                    throw error;
                }
            }
        </script>
        EOD;
    }
}