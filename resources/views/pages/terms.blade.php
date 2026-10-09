@extends('layouts.app')

@section('title', 'Terms & Conditions')
@section('meta_description', 'The terms and conditions governing use of the Xynera website and the services we offer. Read before engaging us for a project.')

@section('content')
<article class="max-w-3xl mx-auto px-6 md:px-8 py-28 md:py-40">

  {{-- Page Header --}}
  <header class="mb-16">
    <p class="text-[0.65rem] font-bold uppercase tracking-[0.25em] text-agency-accent mb-6">Legal</p>
    <h1 class="text-5xl md:text-6xl font-black uppercase tracking-[-0.04em] leading-[0.9] mb-6">
      Terms &amp; <span class="text-grad">Conditions</span>
    </h1>
    <p class="text-agency-muted text-[0.85rem]">Last updated: <time datetime="2026-10-08">8 October 2026</time></p>
    <div class="h-px bg-agency-stroke mt-10"></div>
  </header>

  {{-- Body --}}
  <div class="prose-policy">

    {{-- Intro --}}
    <section class="policy-section">
      <p>These Terms &amp; Conditions ("Terms") apply to your use of the website at <a href="https://xynera.solutions">xynera.solutions</a> ("Site") and to any services provided by Xynera ("we", "us", "our"). By using the Site or engaging us for work, you agree to these Terms.</p>
    </section>

    {{-- 1 --}}
    <section class="policy-section">
      <h2>1. Use of the Website</h2>
      <p>You may use this Site for lawful purposes only. You must not:</p>
      <ul>
        <li>Attempt to gain unauthorised access to any part of the Site or its infrastructure</li>
        <li>Transmit any content that is unlawful, harmful, or misleading</li>
        <li>Use automated tools to scrape or copy Site content without our written permission</li>
        <li>Impersonate Xynera or any of its staff</li>
      </ul>
      <p>We reserve the right to restrict access to the Site for any user at any time without notice.</p>
    </section>

    {{-- 2 --}}
    <section class="policy-section">
      <h2>2. Services</h2>
      <p>Xynera provides web design, web development, mobile application development, UI/UX design, and related digital services.</p>
      <p>This Site is a marketing and contact platform. It does not constitute an offer or contract for services. All project scope, deliverables, timelines, pricing, and payment terms are defined in a separate written proposal or client agreement signed between Xynera and the client before work begins.</p>
      <p>Submitting the contact form does not create a contract or any obligation on either party.</p>
    </section>

    {{-- 3 --}}
    <section class="policy-section">
      <h2>3. Intellectual Property</h2>

      <h3>Site content</h3>
      <p>All content on this Site — including text, graphics, the Xynera logo, design, and code — is owned by or licensed to Xynera and is protected by copyright and other intellectual property laws. You may not reproduce, distribute, or create derivative works from any Site content without our prior written consent.</p>

      <h3>Client work</h3>
      <p>Ownership of deliverables produced for a client project is governed exclusively by the client agreement for that project. Nothing in these Terms grants any rights to client work.</p>
    </section>

    {{-- 4 --}}
    <section class="policy-section">
      <h2>4. Disclaimer of Warranties</h2>
      <p>This Site is provided "as is" and "as available" without warranties of any kind, either express or implied. We do not warrant that the Site will be uninterrupted, error-free, or free of viruses or other harmful components.</p>
      <p>Nothing on this Site constitutes professional legal, financial, or technical advice.</p>
    </section>

    {{-- 5 --}}
    <section class="policy-section">
      <h2>5. Limitation of Liability</h2>
      <p>To the fullest extent permitted by applicable law, Xynera will not be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of, or inability to use, this Site.</p>
      <p>Our total liability for any claim arising from your use of this Site is limited to the greater of (a) the amount you paid us in the three months preceding the claim or (b) USD $100.</p>
      <p>Some jurisdictions do not allow the exclusion of certain warranties or limitation of liability for incidental damages, so some of the above limitations may not apply to you.</p>
    </section>

    {{-- 6 --}}
    <section class="policy-section">
      <h2>6. Third-Party Links</h2>
      <p>This Site may contain links to third-party websites. These links are provided for convenience only. We do not control those sites and are not responsible for their content, privacy practices, or availability. Linking to a third-party site does not imply endorsement.</p>
    </section>

    {{-- 7 --}}
    <section class="policy-section">
      <h2>7. Governing Law</h2>
      <p>These Terms are governed by the laws of <span class="placeholder">[CONFIRM: jurisdiction — e.g. "the State of California, United States" or "England and Wales"]</span>. Any disputes arising under these Terms shall be subject to the exclusive jurisdiction of the courts of that jurisdiction.</p>
    </section>

    {{-- 8 --}}
    <section class="policy-section">
      <h2>8. Changes to These Terms</h2>
      <p>We may update these Terms from time to time. When we do, we will update the "Last updated" date at the top of this page. Continued use of the Site after a change constitutes your acceptance of the revised Terms.</p>
    </section>

    {{-- 9 --}}
    <section class="policy-section">
      <h2>9. Contact</h2>
      <p>If you have questions about these Terms, contact us:</p>
      <p>General inquiries: <a href="mailto:info@xynera.solutions">info@xynera.solutions</a><br>
         New business: <a href="mailto:abdulrehman@xynera.solutions">abdulrehman@xynera.solutions</a><br>
         Address: Palo Alto, CA 94301, United States</p>
    </section>

  </div>{{-- end prose-policy --}}

  {{-- Footer nav --}}
  <div class="mt-16 pt-8 border-t border-agency-stroke flex flex-wrap gap-6">
    <a href="{{ route('home') }}" class="text-agency-muted text-sm hover:text-white transition-colors">← Back to Home</a>
    <a href="{{ route('privacy') }}" class="text-agency-muted text-sm hover:text-agency-accent transition-colors">Privacy Policy →</a>
  </div>

</article>

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
  .prose-policy strong { color: var(--color-agency-text); font-weight: 700; }
  .prose-policy .placeholder { color: #fbbf24; font-style: italic; }
</style>
@endpush

@endsection
