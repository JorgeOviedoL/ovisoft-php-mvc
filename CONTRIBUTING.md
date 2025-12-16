# Guía de Contribución

¡Gracias por tu interés en contribuir a OviSoft PHP MVC Framework! 🎉

## Cómo Contribuir

### Reportar Bugs

Si encuentras un bug, por favor crea un issue con:
- Descripción clara del problema
- Pasos para reproducirlo
- Comportamiento esperado vs actual
- Versión de PHP y servidor web

### Sugerir Mejoras

Las sugerencias son bienvenidas. Crea un issue describiendo:
- La funcionalidad propuesta
- Por qué sería útil
- Ejemplos de uso

### Pull Requests

1. **Fork** el repositorio
2. **Crea una rama** desde `main`:
   ```bash
   git checkout -b feature/nueva-funcionalidad
   ```
3. **Haz tus cambios** siguiendo las guías de estilo
4. **Escribe tests** si es aplicable
5. **Commit** con mensajes descriptivos:
   ```bash
   git commit -m "Add: nueva funcionalidad X"
   ```
6. **Push** a tu fork:
   ```bash
   git push origin feature/nueva-funcionalidad
   ```
7. **Abre un Pull Request** con descripción detallada

## Guías de Estilo

### PHP

- Usar `declare(strict_types=1)` en todos los archivos
- Seguir PSR-12 para estilo de código
- Declarar tipos en parámetros y retornos
- Usar nombres descriptivos en inglés para variables y funciones
- Comentar código complejo

### Commits

Formato: `Tipo: Descripción breve`

Tipos:
- `Add`: Nueva funcionalidad
- `Fix`: Corrección de bug
- `Update`: Actualización de código existente
- `Refactor`: Refactorización sin cambiar funcionalidad
- `Docs`: Cambios en documentación
- `Style`: Cambios de formato (sin afectar código)

### Estructura de Archivos

- Controladores: `nombre.controller.php`
- Modelos: `nombreModel.php`
- Vistas: organizar en subcarpetas por controlador

## Proceso de Revisión

1. Un mantenedor revisará tu PR
2. Se pueden solicitar cambios
3. Una vez aprobado, se fusionará a `main`

## Código de Conducta

- Sé respetuoso y profesional
- Acepta críticas constructivas
- Enfócate en lo mejor para el proyecto

¡Gracias por contribuir! 🚀
