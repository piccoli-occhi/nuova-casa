export type Page = {
    id: number
    created_at: Date
    updated_at: Date
    url: string
    title: string
    icon: string
    favorite: boolean
    readCount: number
    parent: {
        id: number
        name: string
        color: string
    }
}

export type Tag = {
    id: number
    created_at: Date
    updated_at: Date
    url: string
    name: string
    icon: string
    color: string
    children: Array<Pick<Page, "id" | "icon" | "title">>
}

export type Newsletter = {
    id: number
    created_at: Date
    updated_at: Date
    url: string
    name: string
    lastLink: {
        title: string
        link: string
        date: string
    }
}
