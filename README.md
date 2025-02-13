# Welcome to my awesome API Project! 🚀

## API Routes

### Public Routes
| Method | Endpoint | Controller & Action |
|--------|---------|---------------------|
| `GET|HEAD` | `/` | - |
| `POST` | `api/guest/chat` | `GuestChatController@chat` |

### Authentication
| Method | Endpoint | Controller & Action |
|--------|---------|---------------------|
| `POST` | `api/login` | `AuthController@login` |
| `POST` | `api/logout` | `AuthController@logout` |
| `POST` | `api/register` | `AuthController@register` |

### User Routes
| Method | Endpoint | Controller & Action |
|--------|---------|---------------------|
| `GET|HEAD` | `api/user` | - |
| `POST` | `api/user/chat` | `ChatbotController@userChat` |

### Security & Utility
| Method | Endpoint | Controller & Action |
|--------|---------|---------------------|
| `GET|HEAD` | `sanctum/csrf-cookie` | `Laravel\Sanctum\CsrfCookieController@show` |
| `GET|HEAD` | `storage/{path}` | `storage.local` |
| `GET|HEAD` | `up` | - |
