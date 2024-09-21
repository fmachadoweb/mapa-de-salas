# Documentação do Sistema de Mapa de Salas de Aula

## 1. Visão Geral

O Sistema de Mapa de Salas de Aula é um aplicativo Android desenvolvido utilizando WebView, projetado para gerenciar e exibir a disponibilidade e ocupação das salas de aula em uma instituição de ensino. O sistema oferece uma interface intuitiva para visualização do mapa de salas, bem como uma área restrita para atualização de informações por colaboradores autorizados.

## 2. Tecnologias Utilizadas

- Android (WebView)
- PHP
- SQL
- HTML
- CSS
- JavaScript

## 3. Funcionalidades Principais

### 3.1 Visualização do Mapa de Salas

- Exibe um mapa interativo das salas de aula.
- Apresenta uma grade semanal (segunda a sexta) mostrando a disponibilidade de todas as salas.
- Indica o status de ocupação de cada sala (disponível, ocupada).
- Mostra informações sobre quem está utilizando a sala (professor, RH, pedagógico).

### 3.2 Área Restrita para Colaboradores

- Acesso seguro através de login.
- Permite a atualização das informações das salas.
- Interface para modificar status de ocupação, usuário da sala e horários.

### 3.3 Sistema de Log

- Registra todas as ações de login no sistema.
- Captura e armazena informações sobre modificações realizadas.
- Permite o controle e rastreamento das atualizações feitas pelos colaboradores.

## 4. Arquitetura do Sistema

### 4.1 Frontend

- Aplicativo Android utilizando WebView para renderizar a interface web.
- Interface responsiva desenvolvida com HTML, CSS e JavaScript.
- Comunicação com o backend através de requisições AJAX.

### 4.2 Backend

- Servidor PHP para processamento das requisições.
- Banco de dados SQL para armazenamento das informações.
- API RESTful para comunicação entre frontend e backend.

## 5. Fluxo de Dados

1. O aplicativo Android carrega a interface web através do WebView.
2. A interface web faz requisições ao servidor PHP para obter dados.
3. O servidor PHP consulta o banco de dados SQL e retorna as informações.
4. A interface web atualiza dinamicamente com os dados recebidos.
5. Para atualizações, o processo é similar, mas com requisições POST para o servidor.

## 6. Segurança

- Autenticação requerida para acesso à área restrita.
- Todas as senhas são armazenadas de forma criptografada no banco de dados.
- Validação de entrada de dados para prevenir injeções SQL e XSS.
- Uso de HTTPS para todas as comunicações entre o aplicativo e o servidor.

## 7. Manutenção e Atualizações

- Backups regulares do banco de dados devem ser realizados.
- Atualizações de segurança para as tecnologias utilizadas devem ser aplicadas periodicamente.
- Revisões periódicas do código para otimizações e correções de bugs.

## 8. Considerações Futuras

- Implementação de notificações push para alterações em tempo real.
- Expansão para incluir recursos de reserva de salas.
- Desenvolvimento de uma versão web completa para acesso via navegador.

Esta documentação fornece uma visão geral do Sistema de Mapa de Salas de Aula. Para informações mais detalhadas sobre cada componente ou processo, consulte a documentação técnica específica de cada módulo.
