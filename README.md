## Abgabe PhP-Webshop

Anbei uebergeben wir unser PHP-Webshop-Projekt.

### Anleitung

Fuer die Implementierung haben wir uns fuer Docker mit einem Docker-Compose.yaml entschieden. Dieses kann ueber "docker compose up --build" gebaut werden und baut in dem Ueberverzeichnis von Webshop-E-Business ein mysql Ordner als Persistenz des mysql-Service.

Im Ordner db sind das SQL-Skribt "initdb.sql" und das ER-Diagramm der Database webshop hinterlegt.

Anstatt in der Session wird bei uns, wie in der Vorlesung besprochen, der Warenkorb in einer eigenen Tabelle in der webshop Database gespeichert. Zudem existiert eine Tabelle Einkauf, welche bei erfolgreichem Kauf einen neuen Einkauf persistiert. Die neue Einkauf ID wird den Items in dem Warenkorb als Foreign Key zugeordnet. D.h. im Warenkorb wird eine Select-Query ausgeführt welche sich alle Zeilen holt, in denen einkaufid (der Foreign Key) null ist. Gekaufte Artikel werden also in der Tabelle Warenkorb abgespeichert, nicht in Einkauf.

### Einsatz von KI

KI wurde zum generieren der Bilder verwendet. Das Wasserzeichen wurde nachtraeglich auf den Bildern entfernt.

### Projektteam

Gian-Luca Rausa | 193085
Felix Reinbold | 193319
Tobias Hurst | 193385



