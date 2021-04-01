@extends('layouts.master')
@section('title', 'Datenschutz')
@section('header_pagetitle', 'Hinweise zum Datenschutz')


@section('content')
    <div>
        <p class="py-3">
        	Wenn Sie die Internetseite <a href="{{env("APP_URL")}}" class="text-red-600 hover:text-red-700 hover:underline"  class="text-red-600 hover:text-red-700 hover:underline" target="_blank" title="">{{env("APP_URL")}}</a> besuchen und Onlineangebote nutzen,
            werden Daten unter Beachtung des Datenschutzgesetzes gespeichert. Hinsichtlich Art, Umfang und Zweck der Erhebung, Verarbeitung und Nutzung von Daten geben wir
            Ihnen folgende Hinweise.
        </p>
        <h4 class="text-gray-900 font-semibold text-l">
        	1.&nbsp;&nbsp; Was sind personenbezogene Daten?
    	</h4>
        <p class="py-3">
        	Personenbezogene Daten sind laut Bundes- und Landesdatenschutzgesetzen Angaben über persönliche oder sachliche Verhältnisse einer bestimmten oder bestimmbaren
            Person. Dazu gehören z. B. Name, Adresse, Telefonnummer sowie die E-Mail-Adresse, wenn sie den Namen enthält. Welche Daten von Personen, wie lange von welchen
            anderen Personen erfasst und abgespeichert werden dürfen, hängt grundsätzlich aufgrund des Persönlichkeitsschutzes jedes Einzelnen (verfassungsmäßiges Recht auf
            informationelle Selbstbestimmung) von der Einwilligung der jeweiligen Person ab.
        </p>
        <h4 class="text-gray-900 font-semibold text-l">
        	2.&nbsp; &nbsp;Was sind Nutzerdaten und wie werden sie verarbeitet?
    	</h4>
        <p class="py-3">
        	Immer wenn Sie im Internet Seiten aufrufen, werden Daten Ihres Internetbrowsers an den Anbieter der Seite übermittelt, so auch bei Aufruf von 
        	<a href="{{env("APP_URL")}}" target="_self"  class="text-red-600 hover:text-red-700 hover:underline" title="{{env("APP_NAME")}}">{{env("APP_URL")}}</a> an den IT-Dienstleister 
        	<a href="https://itc-halle.de/startseite"  class="text-red-600 hover:text-red-700 hover:underline" target="_self" title="IT-Consult Halle GmbH">IT-Consult Halle GmbH</a>.
        </p>
        <p class="py-3">
        	Diese Daten werden in einer so genannten Protokolldatei gespeichert. Dabei handelt es sich um folgenden Datensatz:
    	</p>
        <ul class="list-inside list-disc py-3">
            <li>Name der abgerufenen Datei</li>
            <li>Datum und Uhrzeit des Abrufs</li>
            <li>Übertragene Datenmenge</li>
            <li>Meldung, ob der Abruf erfolgreich war</li>
            <li>Beschreibung des Typs des verwendeten Webbrowsers</li>
            <li>Anfragende Domain</li>
            <li>Anonymisierte IP-Adresse</li>
        </ul>
        <p class="py-3">
        	Die Daten werden ausschließlich zu statistischen Zwecken erhoben. Diese Website nutzt als Webanalyse-Software Piwik für die statistische Auswertung von
            Besucherzugriffen. Piwik wurde entsprechenden Empfehlungen zur rechtssicheren und datenschutzkonformen Implementierung folgend konfiguriert.</p>
        <p class="py-3">
        	Piwik verwendet "Sitzungs-Cookies", welche nur temporär auf Ihrem Computer gespeichert werden. Sobald der Webbrowser geschlossen wird, werden diese wieder gelöscht.
            Die durch den Cookie erzeugten Informationen werden an den IT-Dienstleister der Stadtverwaltung Halle IT-Consult Halle GmbH übermittelt und nicht an Dritte
            weitergegeben und dienen der Identifikation und Verbesserung relevanter Inhalte unseres Internetangebotes. Durch die Nutzung dieses Internetangebots erklären Sie
            sich mit der Bearbeitung der über Sie erhobenen Daten in der zuvor beschriebenen Art und Weise und nur zu dem zuvor benannten Zweck einverstanden.
        </p>
        <h4 class="text-gray-900 font-semibold text-l">
        	Widerruf der Datenerfassung durch Piwik
    	</h4>
        <p class="py-3">
        	Sie können die Datenerfassung durch Piwik deaktivieren.<br>
            Sie können sich hier entscheiden, ob in Ihrem Browser ein eindeutiger Webanalyse-Cookie abgelegt werden darf, um dem Betreiber der Webseite die Erfassung und
            Analyse verschiedener statistischer Daten zu ermöglichen. <br>
            Wenn Sie sich dagegen entscheiden möchten, klicken Sie den folgenden Link, um den Piwik-Deaktivierungs-Cookie in Ihrem Browser abzulegen.
        </p>
        <p class="py-3">[Kästchen zum Deaktivieren]</p>
        <h4 class="text-gray-900 font-semibold text-l">
        	3. Verwendet die Stadt Halle Cookies?
    	</h4>
        <p class="py-3">
        	Die Stadt Halle (Saale) verwendet weitestgehend keine Cookies. Ausnahmen sind neben der Webanalyse-Software Piwik bei der Nutzung der Schriftgrößeneinstellung, der
            Kontrastvariante sowie elektronischer Angebote, da ansonsten die Nutzung der Funktionen nicht sinnvoll möglich ist.
        </p>
        <p class="py-3">Mehr Informationen zu Cookies:</p>
        <ul class="list-inside list-disc py-3">
            <li><a href="https://www.bsi-fuer-buerger.de/BSIFB/DE/Empfehlungen/EinrichtungSoftware/EinrichtungBrowser/GefahrenRisiken/Cookies/cookies.html"  class="text-red-600 hover:text-red-700 hover:underline"  target="_blank" title="Bundesamt für Sicherheit in der Informationstechnik zum Thema Cookies">Bundesamt für Sicherheit in der Informationstechnik</a></li>
        </ul>
        <h4 class="text-gray-900 font-semibold text-l">
        	4. Wie werden personenbezogene Daten bei elektronischen Angeboten übertragen?
    	</h4>
        <p class="py-3">
        	Die Stadt Halle (Saale) bietet Formulare und elektronische Dienste an. Dort eingetragene Daten zu Ihrer Person werden grundsätzlich in verschlüsselter Form
            übertragen. Über die Art der Verschlüsselung, die erhobenen Daten und den Speicherzweck wird im Kontext der jeweiligen elektronischen Anwendung hingewiesen.</p>
        <p class="py-3">
        	Verschlüsselung macht es sehr schwierig für unberechtigte Personen, die übertragenen Informationen auszuspähen. Es ist daher sehr unwahrscheinlich, dass jemand Ihre
            Daten liest, die Sie über das Internet versenden. Dennoch weisen wir darauf hin, dass die Datenübertragung im Internet Sicherheitslücken aufweisen kann. <br>
            Daher sollte in besonders vertraulichen Angelegenheiten auf andere Arten der Kommunikation zurückgegriffen werden.
        </p>
        <h4 class="text-gray-900 font-semibold text-l">
        	5. Was ist mit personenbezogenen Daten beim E-Mail-Verkehr?
    	</h4>
        <p class="py-3">
        	E-Mails sind schnell und bequem, aber nicht sicher. Die Inhalte können von unbefugten Personen eingesehen oder verfälscht werden, ohne dass der Absender es bemerkt.
            Verzichten Sie daher zu Ihrem eigenen Schutz darauf, vertrauliche Informationen offen über das Internet zu versenden.4
        </p>
        <p class="py-3">
        	Wir empfehlen Ihnen, schützenswerte Informationen nur auf dem herkömmlichen Wege (Post, Fax, ggf. Telefon) zu übermitteln.
    	</p>
        <p class="py-3">Eine virtuelle Poststelle und damit die Möglichkeit, verschlüsselte E-Mails und Dokumente mit qualifizierter elektronischer Signatur zu empfangen und zu senden, sind
            derzeit bei der Stadt Halle (Saale) nicht vorhanden.
        </p>
        <h4 class="text-gray-900 font-semibold text-l">
        	6. Datenschutzbeauftragter
    	</h4>
        <p class="py-3">
        	Der Datenschutzbeauftragte der Stadt Halle (Saale) hat die Aufgabe, Vorschriften des Datenschutzes beratend und kontrollierend in der Stadtverwaltung umzusetzen.
    	</p>
        <p class="py-3">
        	Er ist zentraler Ansprechpartner bei allen datenschutzrechtlichen Fragen im Zusammenhang mit der Stadt Halle (Saale) auch für die Bürgerinnen und Bürger.
        </p>
    </div>
@endsection