@extends('layouts.app')

@section('title', 'Privacy Policy')
@section('meta_description', 'Learn how Xynera collects, uses, and protects your personal information. We keep our data practices simple, transparent, and limited to what is necessary.')

@section('content')
<article class="max-w-3xl mx-auto px-6 md:px-8 py-28 md:py-40">

  {{-- Page Header --}}
  <header class="mb-16">
    <p class="text-[0.65rem] font-bold uppercase tracking-[0.25em] text-agency-accent mb-6">Legal</p>
    <h1 class="text-5xl md:text-6xl font-black uppercase tracking-[-0.04em] leading-[0.9] mb-6">
      Privacy <span class="text-grad">Policy</span>
    </h1>
    <p class="text-agency-muted text-[0.85rem]">Last updated: <time datetime="2026-10-08">8 October 2026</time></p>
    <div class="h-px bg-agency-stroke mt-10"></div>
  </header>

  {{-- Body --}}
  <div class="prose-policy">

    {{-- 1 --}}
    <section class="policy-section">
      <h2>1. Who We Are</h2>
      <p>Xynera is a web design and development agency. Our registered address is Palo Alto, CA 94301, United States.</p>
      <p>For any questions about this policy, contact us at <a href="mailto:info@xynera.solutions">info@xynera.solutions</a>.</p>
    </section>

    {{-- 2 --}}
    <section class="policy-section">
      <h2>2. What Information We Collect</h2>

      <h3>Contact form</h3>
      <p>When you submit our contact form we collect:</p>
      <ul>
        <li>First name and last name</li>
        <li>Email address</li>
        <li>Project type (selected from a list)</li>
        <li>Project details (free-text field)</li>
      </ul>
      <p>We do not collect payment details, phone numbers, or any other information through the website.</p>

      <h3>Automatically collected data</h3>
      <p>Our web server logs standard request data including your IP address, browser type, referring URL, and pages visited. This is collected automatically by the server software and is not linked to your identity.</p>
      <p>We do not use Google Analytics, Meta Pixel, or any third-party analytics service. No tracking pixels or behavioural profiling tools are present on this site.</p>
    </section>

    {{-- 3 --}}
    <section class="policy-section">
      <h2>3. How We Use Your Information</h2>
      <p>We use the information you submit through the contact form to:</p>
      <ul>
        <li>Respond to your project inquiry</li>
        <li>Send you a copy of your inquiry to our team email inbox</li>
        <li>Keep a record of inbound inquiries in our secure database</li>
      </ul>
      <p>We do not use your data for advertising, profiling, or automated decision-making. We do not sell, rent, or share your personal data with third parties for their own marketing purposes.</p>
    </section>

    {{-- 4 --}}
    <section class="policy-section">
      <h2>4. Third-Party Services</h2>
      <p>This site uses the following third-party services. Each operates under its own privacy policy.</p>

      <h3>Google Fonts</h3>
      <p>We load the Public Sans typeface and Material Symbols icon set from <code>fonts.googleapis.com</code> and <code>fonts.gstatic.com</code>. When your browser fetches these files, Google receives your IP address and browser information. We do not control what Google does with this data. See <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Google's Privacy Policy</a>.</p>

      <h3>Email delivery</h3>
      <p>Contact form submissions are delivered to our inbox via the email service configured on our server. <span class="placeholder">[CONFIRM: name the mail provider you use — e.g. Mailgun, SendGrid, Postmark, or your hosting SMTP]</span>. That provider may process your name and email address in transit.</p>
    </section>

    {{-- 5 --}}
    <section class="policy-section">
      <h2>5. Cookies and Local Storage</h2>

      <h3>Essential cookies</h3>
      <p>This site sets one session cookie named <code>xynera_session</code> (or the name configured in your hosting environment). It exists only to handle form submission security (CSRF protection) and expires when you close your browser. It does not track you across sites.</p>

      <h3>Local storage — admin panel only</h3>
      <p>The admin dashboard stores a <code>theme</code> preference in your browser's local storage so the panel remembers whether you chose dark or light mode. This data never leaves your device and is only written if you log in to the admin area.</p>

      <h3>No non-essential cookies</h3>
      <p>We do not set advertising, analytics, or tracking cookies. You do not need to accept anything to use this site.</p>

      <h3>How to control cookies</h3>
      <p>You can delete or block cookies through your browser settings at any time. Blocking the session cookie will prevent the contact form from working correctly.</p>
    </section>

    {{-- 6 --}}
    <section class="policy-section">
      <h2>6. How Long We Keep Your Data</h2>
      <p>Contact form submissions are stored in our database for as long as we maintain an active business relationship with you, or for a maximum of <span class="placeholder">[CONFIRM: your retention period, e.g. 3 years]</span> from the date of submission, after which they are deleted.</p>
      <p>Server logs are retained for <span class="placeholder">[CONFIRM: e.g. 30 days]</span> and then deleted automatically.</p>
    </section>

    {{-- 7 --}}
    <section class="policy-section">
      <h2>7. Your Rights</h2>
      <p>You have the right to:</p>
      <ul>
        <li><strong>Access</strong> — request a copy of the personal data we hold about you</li>
        <li><strong>Correction</strong> — ask us to correct inaccurate data</li>
        <li><strong>Deletion</strong> — ask us to delete your data</li>
        <li><strong>Objection</strong> — object to our processing of your data</li>
      </ul>
      <p>To exercise any of these rights, email <a href="mailto:info@xynera.solutions">info@xynera.solutions</a>. We will respond within 30 days.</p>
      <p><span class="placeholder">[CONFIRM: If you serve users in the EU or UK, add a sentence here about the right to lodge a complaint with a supervisory authority (e.g. the ICO in the UK or relevant EU DPA).]</span></p>
    </section>

    {{-- 8 --}}
    <section class="policy-section">
      <h2>8. Children's Privacy</h2>
      <p>This website is not directed at children under the age of 13. We do not knowingly collect personal data from children. If you believe a child has submitted information through this site, contact us at <a href="mailto:info@xynera.solutions">info@xynera.solutions</a> and we will delete it promptly.</p>
    </section>

    {{-- 9 --}}
    <section class="policy-section">
      <h2>9. Changes to This Policy</h2>
      <p>If we make material changes to this policy, we will update the "Last updated" date at the top of this page. We encourage you to review this page periodically. Continued use of the site after a change constitutes acceptance of the revised policy.</p>
    </section>

    {{-- 10 --}}
    <section class="policy-section">
      <h2>10. Contact</h2>
      <p>General inquiries: <a href="mailto:info@xynera.solutions">info@xynera.solutions</a><br>
         New business: <a href="mailto:abdulrehman@xynera.solutions">abdulrehman@xynera.solutions</a></p>
    </section>

  </div>{{-- end prose-policy --}}

  {{-- Footer nav --}}
  <div class="mt-16 pt-8 border-t border-agency-stroke flex flex-wrap gap-6">
    <a href="{{ route('home') }}" class="text-agency-muted text-sm hover:text-white transition-colors">← Back to Home</a>
    <a href="{{ route('terms') }}" class="text-agency-muted text-sm hover:text-agency-accent transition-colors">Terms &amp; Conditions →</a>
  </div>

</article>

{{-- Inline prose styles — scoped, no extra file needed --}}
@push('styles')
<style>
  .prose-policy { color: var(--color-agency-muted); line-height: 1.8; font-size: 0.95rem; }
  .prose-policy .policy-section { margin-bottom: 3rem; }
  .prose-policy h2 {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--color-agency-text);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--color-agency-stroke);
  }
  .prose-policy h3 {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--color-agency-text);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
  }
  .prose-policy p { margin-bottom: 0.9rem; }
  .prose-policy ul { list-style: none; padding: 0; margin-bottom: 0.9rem; }
  .prose-policy ul li { padding-left: 1.4rem; position: relative; margin-bottom: 0.3rem; }
  .prose-policy ul li::before { content: '—'; position: absolute; left: 0; color: var(--color-agency-accent); font-weight: 700; }
  .prose-policy a { color: var(--color-agency-accent); text-decoration: none; }
  .prose-policy a:hover { text-decoration: underline; }
  .prose-policy code { font-size: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--color-agency-stroke); padding: 0.1em 0.4em; border-radius: 4px; color: var(--color-agency-text); }
  .prose-policy strong { color: var(--color-agency-text); font-weight: 700; }
  .prose-policy .placeholder { color: #fbbf24; font-style: italic; }
</style>
@endpush

@endsection
