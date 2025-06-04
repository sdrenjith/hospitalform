@props([
    'navigation',
])

@php
    $openSidebarClasses = 'fi-sidebar-open w-[--sidebar-width] translate-x-0 shadow-xl ring-1 ring-gray-950/5 dark:ring-white/10 rtl:-translate-x-0';
    $isRtl = __('filament-panels::layout.direction') === 'rtl';
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    
    .enhanced-sidebar {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        border-right: 1px solid #e2e8f0;
    }
    
    .dark .enhanced-sidebar {
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        border-right: 1px solid #334155;
    }
    
    .sidebar-header-enhanced {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-bottom: 1px solid #e2e8f0;
        backdrop-filter: blur(10px);
    }
    
    .dark .sidebar-header-enhanced {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-bottom: 1px solid #334155;
    }
    
    .nav-item {
        position: relative;
        margin: 0.25rem 0;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    
    .nav-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(29, 78, 216, 0.1) 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
        z-index: 0;
    }
    
    .nav-item:hover::before {
        transform: scaleX(1);
    }
    
    .nav-item:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.15);
    }
    
    .nav-item.active {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.3);
        transform: translateX(4px);
    }
    
    .nav-item.active::before {
        background: rgba(255, 255, 255, 0.1);
        transform: scaleX(1);
    }
    
    .nav-link {
        position: relative;
        display: flex;
        align-items: center;
        padding: 12px 16px;
        color: #64748b;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        z-index: 1;
    }
    
    .nav-item:hover .nav-link {
        color: #3b82f6;
    }
    
    .nav-item.active .nav-link {
        color: white;
        font-weight: 600;
    }
    
    .nav-icon {
        width: 20px;
        height: 20px;
        margin-right: 12px;
        transition: all 0.3s ease;
        opacity: 0.7;
    }
    
    .nav-item:hover .nav-icon {
        opacity: 1;
        transform: scale(1.1);
    }
    
    .nav-item.active .nav-icon {
        opacity: 1;
        transform: scale(1.1);
    }
    
    .nav-text {
        transition: all 0.3s ease;
    }
    
    .nav-item:hover .nav-text {
        transform: translateX(2px);
    }
    
    .sidebar-logo {
        transition: all 0.3s ease;
        background: transparent;
        padding: 8px;
        border-radius: 8px;
    }
    
    .sidebar-logo:hover {
        transform: scale(1.05);
        background: rgba(59, 130, 246, 0.05);
    }
    
    .sidebar-logo img,
    .sidebar-logo svg {
        background: transparent !important;
        border-radius: 6px;
    }
    
    .sidebar-group-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        margin: 24px 16px 8px 16px;
        padding-bottom: 4px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .dark .sidebar-group-label {
        color: #64748b;
        border-bottom-color: #334155;
    }
    
    .sidebar-nav-enhanced {
        padding: 16px 12px;
    }
    
    /* Scroll bar styling */
    .sidebar-nav-enhanced::-webkit-scrollbar {
        width: 4px;
    }
    
    .sidebar-nav-enhanced::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .sidebar-nav-enhanced::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 2px;
    }
    
    .sidebar-nav-enhanced::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    .expand-collapse-btn {
        transition: all 0.3s ease;
        border-radius: 8px;
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    
    .expand-collapse-btn:hover {
        background: rgba(59, 130, 246, 0.2);
        transform: scale(1.05);
        color: #1d4ed8;
    }
    
    .dark .expand-collapse-btn {
        background: rgba(148, 163, 184, 0.1);
        color: #94a3b8;
    }
    
    .dark .expand-collapse-btn:hover {
        background: rgba(148, 163, 184, 0.2);
        color: #cbd5e1;
    }
</style>

{{-- format-ignore-start --}}
<aside
    x-data="{}"
    @if (filament()->isSidebarCollapsibleOnDesktop() && (! filament()->hasTopNavigation()))
        x-cloak
        x-bind:class="
            $store.sidebar.isOpen
                ? @js($openSidebarClasses . ' ' . 'lg:sticky')
                : '-translate-x-full rtl:translate-x-full lg:sticky lg:translate-x-0 rtl:lg:-translate-x-0'
        "
    @else
        @if (filament()->hasTopNavigation())
            x-cloak
            x-bind:class="$store.sidebar.isOpen ? @js($openSidebarClasses) : '-translate-x-full rtl:translate-x-full'"
        @elseif (filament()->isSidebarFullyCollapsibleOnDesktop())
            x-cloak
            x-bind:class="$store.sidebar.isOpen ? @js($openSidebarClasses . ' ' . 'lg:sticky') : '-translate-x-full rtl:translate-x-full'"
        @else
            x-cloak="-lg"
            x-bind:class="
                $store.sidebar.isOpen
                    ? @js($openSidebarClasses . ' ' . 'lg:sticky')
                    : 'w-[--sidebar-width] -translate-x-full rtl:translate-x-full lg:sticky'
            "
        @endif
    @endif
    {{
        $attributes->class([
            'fi-sidebar enhanced-sidebar fixed inset-y-0 start-0 z-30 flex flex-col h-screen content-start transition-all lg:z-0 lg:shadow-none lg:ring-0 lg:transition-none',
            'lg:translate-x-0 rtl:lg:-translate-x-0' => ! (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop() || filament()->hasTopNavigation()),
            'lg:-translate-x-full rtl:lg:translate-x-full' => filament()->hasTopNavigation(),
        ])
    }}
>
    <div class="overflow-x-clip">
        <header class="sidebar-header-enhanced flex h-16 items-center px-6">
            <div
                @if (filament()->isSidebarCollapsibleOnDesktop())
                    x-show="$store.sidebar.isOpen"
                    x-transition:enter="lg:transition lg:delay-100"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                @endif
                class="sidebar-logo"
            >
                @if ($homeUrl = filament()->getHomeUrl())
                    <a {{ \Filament\Support\generate_href_html($homeUrl) }}>
                        <x-filament-panels::logo />
                    </a>
                @else
                    <x-filament-panels::logo />
                @endif
            </div>

            @if (filament()->isSidebarCollapsibleOnDesktop())
                <x-filament::icon-button
                    color="gray"
                    :icon="$isRtl ? 'heroicon-o-chevron-left' : 'heroicon-o-chevron-right'"
                    :icon-alias="$isRtl ? ['panels::sidebar.expand-button.rtl', 'panels::sidebar.expand-button'] : 'panels::sidebar.expand-button'"
                    icon-size="lg"
                    :label="__('filament-panels::layout.actions.sidebar.expand.label')"
                    x-cloak
                    x-data="{}"
                    x-on:click="$store.sidebar.open()"
                    x-show="! $store.sidebar.isOpen"
                    class="mx-auto expand-collapse-btn"
                />
            @endif

            @if (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop())
                <x-filament::icon-button
                    color="gray"
                    :icon="$isRtl ? 'heroicon-o-chevron-right' : 'heroicon-o-chevron-left'"
                    :icon-alias="$isRtl ? ['panels::sidebar.collapse-button.rtl', 'panels::sidebar.collapse-button'] : 'panels::sidebar.collapse-button'"
                    icon-size="lg"
                    :label="__('filament-panels::layout.actions.sidebar.collapse.label')"
                    x-cloak
                    x-data="{}"
                    x-on:click="$store.sidebar.close()"
                    x-show="$store.sidebar.isOpen"
                    class="ms-auto hidden lg:flex expand-collapse-btn"
                />
            @endif
        </header>
    </div>

    <nav class="sidebar-nav-enhanced flex-grow flex flex-col gap-y-2 overflow-y-auto overflow-x-hidden" style="scrollbar-gutter: stable">
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_NAV_START) }}

        @if (filament()->hasTenancy() && filament()->hasTenantMenu())
            <div
                @class([
                    'fi-sidebar-nav-tenant-menu-ctn',
                    '-mx-2' => ! filament()->isSidebarCollapsibleOnDesktop(),
                ])
                @if (filament()->isSidebarCollapsibleOnDesktop())
                    x-bind:class="$store.sidebar.isOpen ? '-mx-2' : '-mx-4'"
                @endif
            >
                <x-filament-panels::tenant-menu />
            </div>
        @endif

        <!-- Enhanced Navigation Items -->
        <div class="fi-sidebar-nav-groups flex flex-col gap-y-1">
            @foreach ($navigation as $group)
                @if ($group->getLabel())
                    <div class="sidebar-group-label">{{ $group->getLabel() }}</div>
                @endif
                
                @foreach ($group->getItems() as $item)
                    <div class="nav-item {{ $item->isActive() ? 'active' : '' }}">
                        <a href="{{ $item->getUrl() }}" class="nav-link">
                            @if ($item->getIcon())
                                <x-filament::icon
                                    :icon="$item->getIcon()"
                                    class="nav-icon"
                                />
                            @endif
                            <span class="nav-text">{{ $item->getLabel() }}</span>
                            @if ($item->getBadge())
                                <span class="ml-auto">
                                    <x-filament::badge
                                        :color="$item->getBadgeColor()"
                                        size="xs"
                                    >
                                        {{ $item->getBadge() }}
                                    </x-filament::badge>
                                </span>
                            @endif
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>

        <script>
            var collapsedGroups = JSON.parse(
                localStorage.getItem('collapsedGroups'),
            )

            if (collapsedGroups === null || collapsedGroups === 'null') {
                localStorage.setItem(
                    'collapsedGroups',
                    JSON.stringify(@js(
                        collect($navigation)
                            ->filter(fn (\Filament\Navigation\NavigationGroup $group): bool => $group->isCollapsed())
                            ->map(fn (\Filament\Navigation\NavigationGroup $group): string => $group->getLabel())
                            ->values()
                            ->all()
                    )),
                )
            }

            collapsedGroups = JSON.parse(
                localStorage.getItem('collapsedGroups'),
            )

            document
                .querySelectorAll('.fi-sidebar-group')
                .forEach((group) => {
                    if (
                        !collapsedGroups.includes(group.dataset.groupLabel)
                    ) {
                        return
                    }

                    group.querySelector(
                        '.fi-sidebar-group-items',
                    ).style.display = 'none'
                    group
                        .querySelector('.fi-sidebar-group-collapse-button')
                        .classList.add('rotate-180')
                })
        </script>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_NAV_END) }}
    </nav>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_FOOTER) }}
</aside>
{{-- format-ignore-end --}}